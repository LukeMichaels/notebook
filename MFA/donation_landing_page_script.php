logIt.log("mfa_multistep_main v19.8.2");

var mwdspace = window.mwdspace || {};
/* Create an AB Tasty variable if one does not exist  */
window._abtasty = window._abtasty || [];

/*
Note: several bank account related lines of code have been commented out as opposed to deleted, in case MFA wants to add that payment option soon.
*/

/* *********************************************************** */
jqdd(document).ready(function() {
	/* value overrides */
	/* method overrides */
	ddLinkedField.prototype.updateValidity = function(isValid, options) {
		var isValid = isValid || false;
		var options = options || {};

		var feedback = options.validateHint || this.validateHint;
		if (isValid) {
			this.sourceObject
				.removeClass(fieldLinkClasses.INVALID)
				.addClass(fieldLinkClasses.VALID)
				.closest("div.inputBox")
				.removeClass(fieldLinkClasses.INVALID)
				.addClass(fieldLinkClasses.VALID);
			// if (this.sourceObject.attr("id") == "customBankOptIn") {
			// 	/* mark the container for the entire Bank Opt In group */
			// 	this.sourceObject
			// 		.closest("p.bankOptIn")
			// 		.removeClass(fieldLinkClasses.INVALID)
			// 		.addClass(fieldLinkClasses.VALID);
			// }
			this.sourceObject
				.closest("div.inputBox")
				.next("div.hint.invalid")
				.slideUp(333);
		} else {
			this.sourceObject
				.removeClass(fieldLinkClasses.VALID)
				.addClass(fieldLinkClasses.INVALID)
				.closest("div.inputBox")
				.removeClass(fieldLinkClasses.VALID)
				.addClass(fieldLinkClasses.INVALID);
			// if (this.sourceObject.attr("id") == "customBankOptIn") {
			// 	/* mark the container for the entire Bank Opt In group */
			// 	this.sourceObject
			// 		.closest("p.bankOptIn")
			// 		.removeClass(fieldLinkClasses.VALID)
			// 		.addClass(fieldLinkClasses.INVALID);
			// }
			this.sourceObject
				.closest("div.inputBox")
				.next("div.hint.invalid")
				.html(feedback)
				.slideDown(444);
		}
	};

	ddLinkedSubmit.prototype.okToSubmit = function() {
		resetUserMessage();
		var noErrorsFound = true;
		var donationAmount = getCmsSystemGiftAmount();
		if (donationAmount == "undefined" || isNaN(donationAmount)) {
			addUserMessage(
				"Sorry, an internal error occured with the donation amount. Please re-select an amount and try again."
			);

			logIt.warn(
				"Donation amount in EN system gift was bad or null [" + donationAmount + "]"
			);
			return false; // stop checking the rest due to unexpected error
		}

		var systemPayType = getCurrentSystemPayTypeObject();
		if (systemPayType.val() == "") {
			if (jqCustom.find("div.button.payMethod.bank").hasClass("selected")) {
				addUserMessage(
					"Sorry! An internal error occured with the Payment Information section. Please re-enter your payment information and try again."
				);
			} else {
				addUserMessage(
					"Please complete the Payment Information section and ensure that the proper credit card has been selected."
				);
			}

			return false;
		}

		if (donationAmount < currentMinimumAmount) {
			addUserMessage(
				"The current donation amount isn't valid. Please select an amount of&nbsp;$" +
					currentMinimumAmount +
					"&nbsp;or&nbsp;more."
			);
			noErrorsFound = false;
		}

		/*
	if (!jqCustom.find("input#customBankOptIn").prop("checked")) {
		if (jqCustom.find("input#customPayMethod_Bank").prop("checked")) {
			// trigger field validation to highlight it
			jqCustom.find("input#customBankOptIn").trigger("change");
			addUserMessage(
				"To continue, please check the box to acknowledge that payment will be withdrawn from your bank account."
			);
			noErrorsFound = false;
		} else {
			// EN system mistakenly requires bank optin on PayPal submit.
			// select it, but ensure it's reset back in case of page reload
			jqCustom.find("input#customBankOptIn")
				.prop("checked", true)
				.trigger("change");
			setStoredValue("checkbox_customBankOptIn", false);
		}
	}
	*/

		// ensure region is either updated or indicating invalid if not
		var jqVisibleRegion = getVisibleRegionObject();
		jqVisibleRegion.trigger("change");

		return noErrorsFound;
	};

	var initialLoad = true;

	var askStringOrderLocked = false;
	var bankOptInField = {};
	var baseGiftAmount = 0;
	var extraGiftAmount = 0;
	var currentCurrencyCode = "";
	var currentCurrencySymbol = "";
	var currentMinimumAmount = MINIMUM_DONATION_AMOUNT;

	/* handle any undeclared global set option values */
	if (typeof isMonthlyOnlyPage == "undefined") {
		isMonthlyOnlyPage = false;
	}
	if (typeof defaultFrequencyIsMonthly == "undefined") {
		defaultFrequencyIsMonthly = false;
	}
	if (typeof addAnnualRecurring == "undefined") {
		addAnnualRecurring = false;
	}
	if (typeof defaultFrequencyIsAnnual == "undefined") {
		defaultFrequencyIsAnnual = false;
	}
	if (typeof reverseAskString == "undefined") {
		var reverseAskString = false;
	} else {
		askStringOrderLocked = true;
	}

	var jqCustomGiftFreq = jqCustom.find("div#customGiftFreq");
	var jqCustomGiftString = jqCustom.find("div#customGiftString");
	var jqExtraPercent = jqCustom.find("input#customExtraPercent");
	var jqUserMessage = jqCustom.find("div.userMessage");
	var jqSystemAmountField = jqSystem.find("input#en__field_transaction_donationAmt");
	var jqCardNumberInput = jqCustom.find("input.cardNbr");

	mwdspace.multiStepMode = !jqCustom.find("div.mainContent").hasClass("singleStep");

	/* check if page should be in TY mode */
	var htmlSystemTy = jqSystem.find("div.tyMessage");
	if (htmlSystemTy.length > 0) {
		recordTransaction();
		buildTyContent(htmlSystemTy.html());
		showCustomForm(333);
		forgetStoredValue("stepName");
	} else {
		/* handle EN system generated response errors */
		var systemErrorList = jqSystem.find("ul.en__errorList li");
		if (systemErrorList.length > 0) {
			var userMessages = ["<strong>The server reported the following issues:</strong>"];
			var errorText;
			systemErrorList.each(function() {
				errorText = "<br>" + overrideSystemErrorMessage(jqdd(this).html());
				userMessages += jqdd.trim(errorText);
			});
			if (userMessages.length > 1) {
				addUserMessage(userMessages);
			}
		}

		/* move other source content to target containers */
		//security seal
		var sourceSecuritySeal = jqSystem.find("div.securitySealSource");
		if (sourceSecuritySeal.length > 0) {
			jqCustom
				.find("div.securitySealTarget")
				.empty()
				.append(sourceSecuritySeal);
		}

		/* AMOUNT LINKING */

		var giftFreqSingle = new ddLinkedField(
			jqCustom.find("input.giftFreq.single"),
			jqSystem.find("input#en__field_transaction_recurrpay0"),
			{
				rememberValue: true,
				prefillUrlArg: "single",
			}
		);
		var giftFreqMonthly = new ddLinkedField(
			jqCustom.find("input.giftFreq.monthly"),
			jqSystem.find("input#en__field_transaction_recurrpay1"),
			{
				rememberValue: true,
				prefillUrlArg: "monthly",
			}
		);

		var giftFreqAnnual = null;
		if (addAnnualRecurring) {
			var htmlAnnualButton =
				'<div class="widthSizer"><input id="customGiftFreq_Annual" class="giftFreq annual" type="radio" name="groupGiftFreq"/><label class="giftFreq annual" for="customGiftFreq_Annual">Annual</label></div>';
			jqCustomGiftFreq.find("div.groupGiftFreq").append(htmlAnnualButton);
			giftFreqAnnual = new ddLinkedField(
				jqCustom.find("input.giftFreq.annual"),
				jqSystem.find("input#en__field_transaction_recurrpay1"),
				{
					rememberValue: true,
					prefillUrlArg: "annual",
				}
			);
		}
		initFrequencyElements();

		/*CARD PAY OPTION EVENTS*/
		// jqCustom.find("input#customPayMethod_Card").change(function(event) {
		// 	setPaymentSystemInfo(jqdd(this));
		// 	jqCustom.find("label.button.payMethod").removeClass("hideSelected");
		// });
		// jqdd(
		// 	"div.payMethodContainer label.payMethod.card, div.staticPayMethodIndicators p.button.payMethod.card"
		// ).click(function(event) {
		// 	jqCustom
		// 		.find("input#customPayMethod_Card")
		// 		.prop("checked", true)
		// 		.trigger("change");
		// 	goToStep("payment", "mainPayButton");
		// });
		// /*BANK PAY OPTION EVENTS*/
		// jqCustom.find("input#customPayMethod_Bank").change(function() {
		// 	setPaymentSystemInfo(jqdd(this));
		// });
		// jqdd(
		// 	"div.payMethodContainer label.payMethod.bank, div.staticPayMethodIndicators p.button.payMethod.bank"
		// ).click(function() {
		// 	jqCustom
		// 		.find("input#customPayMethod_Bank")
		// 		.prop("checked", true)
		// 		.trigger("change");
		// });
		// /*PAYPAL PAY OPTION EVENTS*/
		// jqCustom.find("input#customPayMethod_Paypal").change(function() {
		// 	setPaymentSystemInfo(jqdd(this));
		// });
		// jqCustom.find("div.payMethodContainer label.payMethod.paypal").click(function() {
		// 	jqCustom
		// 		.find("input#customPayMethod_Paypal")
		// 		.prop("checked", true)
		// 		.trigger("change");
		// });
		// jqCustom
		// 	.find("div.staticPayMethodIndicators p.button.payMethod.paypal")
		// 	.click(function() {
		// 		jqCustom
		// 			.find("input#customPayMethod_Paypal")
		// 			.prop("checked", true)
		// 			.trigger("change");
		// 	});

		/* show only one of the payment method sections */
		// if (getStoredValue("payMethodSelectionId")) {
		// 	jqCustom
		// 		.find("input#" + getStoredValue("payMethodSelectionId"))
		// 		.prop("checked", true)
		// 		.trigger("change");
		// } else {
		// 	jqCustom.find("input#customPayMethod_Card").trigger("change");
		// 	jqCustom.find("label.button.payMethod.card").addClass("hideSelected"); //for first view only
		// }

		if (getStoredValue("extraPercentEnabled")) {
			jqExtraPercent.prop("checked", true).trigger("change");
		}
		jqExtraPercent.on("change", processExtraPercent);

		/* move intro source content to target containers */
		// logo (with enclosing a tag)
		var sourceMainLogo = jqSystem.find("div.introContentSource a.mainLogo");
		if (sourceMainLogo.length > 0) {
			jqCustom
				.find("div.mainLogoTarget")
				.empty()
				.append(sourceMainLogo);
		}
		// headline (h2 tags)
		var sourceIntroHeader = jqSystem.find("div.introContentSource h2");
		if (sourceIntroHeader.length > 0) {
			jqCustom
				.find("div.introHeaderTarget")
				.empty()
				.append(sourceIntroHeader);
		}
		// intro text (p and h3 tags)
		var sourceIntroBody = jqSystem.find(
			"div.introContentSource p, div.introContentSource h3"
		);
		if (sourceIntroBody.length > 0) {
			jqCustom.find("div.introBodyTarget").empty();
			sourceIntroBody.each(function() {
				jqdd(this)
					.addClass("giftIntro")
					.appendTo(jqCustom.find("div.introBodyTarget"));
			});
		}
		// text to show over all steps
		var sourceAllStepTextHtml = jqSystem.find("div.allStepTextSource").html();
		if (sourceAllStepTextHtml) {
			jqCustom
				.find("div.allStepTextTarget")
				.html(sourceAllStepTextHtml)
				.parent()
				.show();
		}
		// additional intro copy over first step
		var sourceAdditionalIntroHtml = jqSystem.find("div.additionalIntroSource").html();
		if (sourceAdditionalIntroHtml) {
			jqCustom
				.find("div.additionalIntroTarget")
				.html(sourceAdditionalIntroHtml)
				.parent()
				.show();
		}

		/* INFO FIELD LINKING */

		var jqCustomCurrency = jqCustom.find("select#customCurrency");
		var jqSystemCurrency = jqSystem.find("select#en__field_transaction_paycurrency");
		var paymentCurrency = new ddLinkedField(jqCustomCurrency, jqSystemCurrency, {
			initializeFromTarget: true,
			isRequired: true,
			prefillUrlArg: "currency",
			rememberValue: true,
			validatePattern: Pattern.ALPHA_ONLY,
			validateHint: "Please select your currency",
			onChange: processCurrencyChange,
		});
		jqCustomCurrency.trigger("change");

		/* DISPLAY MAIN CONTENT AFTER CURRENCY ESTABLISHED */
		if (mwdspace.multiStepMode) {
			if (getStoredValue("stepName")) {
				goToStep(getStoredValue("stepName"));
			} else {
				goToStep("gift");
			}
		}
		showCustomForm(666);

		var firstNameField = new ddLinkedField(
			jqCustom.find("input.firstName"),
			jqSystem.find("input#en__field_supporter_firstName"),
			{
				initializeFromTarget: true,
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.AT_LEAST_ALPHA,
				validateHint: "Please enter at least 1 letter",
			}
		);
		var lastNameField = new ddLinkedField(
			jqCustom.find("input.lastName"),
			jqSystem.find("input#en__field_supporter_lastName"),
			{
				initializeFromTarget: true,
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.AT_LEAST_ALPHA,
				validateHint: "Please enter at least 1 letter",
			}
		);
		var streetField = new ddLinkedField(
			jqCustom.find("input.street"),
			jqSystem.find("input#en__field_supporter_address1"),
			{
				initializeFromTarget: true,
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.AT_LEAST_ALPHA,
				validateHint: "Please enter at least 1 letter",
			}
		);
		var cityField = new ddLinkedField(
			jqCustom.find("input.city"),
			jqSystem.find("input#en__field_supporter_city"),
			{
				initializeFromTarget: true,
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.AT_LEAST_ALPHA,
				validateHint: "Please enter at least 1 letter",
			}
		);

		var jqCustomCountry = jqCustom.find("select#customCountry");
		var paymentCountry = new ddLinkedField(
			jqCustomCountry,
			jqSystem.find("select#en__field_supporter_country"),
			{
				initializeFromTarget: true,
				isRequired: true,
				prefillUrlArg: "country",
				rememberValue: true,
				validatePattern: Pattern.ALPHANUMERIC,
				validateHint: "Please select a country",
				onChange: function(jqElement) {
					jqCustom
						.find(
							"div.inputBox.region input.region, div.inputBox.region select.region"
						)
						.hide();
					var jqVisibleRegion = getVisibleRegionObject();
					jqVisibleRegion.fadeIn(333);
					jqVisibleRegion.trigger("update");
				},
			}
		);

		// state/region/province must be after country
		var jqSystemRegion = jqSystem.find("input#en__field_supporter_region");
		// general write in region
		var regionOpenField = new ddLinkedField(
			jqCustom.find("input#customRegion_Open"),
			jqSystemRegion,
			{
				initializeFromTarget: true,
				isRequired: true,
				prefillUrlArg: "region",
				rememberValue: true,
				validatePattern: Pattern.ALPHANUMERIC,
				validateHint: "Please enter a region, province or state",
			}
		);
		// US states
		var regionUsField = new ddLinkedField(
			jqCustom.find("select#customRegion_US"),
			jqSystemRegion,
			{
				initializeFromTarget: true,
				isRequired: true,
				prefillUrlArg: "region",
				rememberValue: true,
				validatePattern: Pattern.ALPHANUMERIC,
				validateHint: "Please select a state or U.S. territory",
			}
		);
		// Canadian provinces
		var regionCaField = new ddLinkedField(
			jqCustom.find("select#customRegion_CA"),
			jqSystemRegion,
			{
				initializeFromTarget: true,
				isRequired: true,
				prefillUrlArg: "region",
				rememberValue: true,
				validatePattern: Pattern.ALPHANUMERIC,
				validateHint: "Please select a province",
			}
		);

		// prep country and region fields
		jqCustomCountry.trigger("change");

		var emailField = new ddLinkedField(
			jqCustom.find("input.email"),
			jqSystem.find("input#en__field_supporter_emailAddress"),
			{
				initializeFromTarget: true,
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.EMAIL,
				validateHint: "This may not be a valid email address",
			}
		);

		var phoneField = new ddLinkedField(
			jqCustom.find("input.phone"),
			jqSystem.find("input#en__field_supporter_phoneNumber"),
			{
				initializeFromTarget: true,
				isRequired: false,
				rememberValue: true,
				validatePattern: Pattern.PHONE,
				validateHint: "Phone must have at least 7 digits",
			}
		);

		var postCodeField = new ddLinkedField(
			jqCustom.find("input.zip"),
			jqSystem.find("input#en__field_supporter_postcode"),
			{
				initializeFromTarget: true,
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.ALPHANUMERIC,
				validateHint: "Please enter a zip/postal code",
			}
		);

		/* CARD FIELD LINKING */
		var cardNbrField = new ddLinkedField(
			jqCardNumberInput,
			jqSystem.find("input#en__field_transaction_ccnumber"),
			{
				isRequired: true,
				rememberValue: false,
				validateCardNumber: true,
				validateHint: "This card number looks incorrect",
				useEmptyValue: "0",
				onKeyUp: processCardNumberInput,
				onChange: processCardNumberInput,
				onBlur: processCardNumberInput,
				onPaste: processCardNumberInput,
			}
		);
		var cardCvvField = new ddLinkedField(
			jqCustom.find("input.cardCvv"),
			jqSystem.find("input#en__field_transaction_ccvv"),
			{
				isRequired: true,
				rememberValue: false,
				validatePattern: Pattern.CARD_CVV,
				validateHint: "Please enter either 3 or 4 digits",
				useEmptyValue: "0",
			}
		);
		var initialMonth = get2DigitMonth();
		var cardExpireMonthField = new ddLinkedField(
			jqCustom.find("select#customCardExpireMonth"),
			jqSystem.find('input[name="transaction.ccexpire"]').eq(0),
			{
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.CARD_MONTH,
				validateHint: "Please select the expiration month",
				useEmptyValue: initialMonth,
			}
		);
		var currentYear = new Date().getFullYear();
		var cardExpireYearField = new ddLinkedField(
			jqCustom.find("select#customCardExpireYear"),
			jqSystem.find('input[name="transaction.ccexpire"]').eq(1),
			{
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.CARD_YEAR,
				buildYearSelect: {
					count: 12,
					useFourDigitYears: true,
				},
				validateHint: "Please select the expiration year",
				useEmptyValue: currentYear,
			}
		);
		/* BANK ACCT FIELD LINKING */
		/*

		// bank payments may be enabled in the not too distant future

		var bankRoutingNbrField = new ddLinkedField(
			jqCustom.find("input#customBankRoutingNbr"),
			jqSystem.find("input#en__field_supporter_bankRoutingNumber"),
			{
				isRequired: true,
				rememberValue: true,
				validatePattern: Pattern.ABA_ROUTING,
				validateHint: "Please enter 9 digits",
				useEmptyValue: "0",
			}
		);
		var bankAcctNbrField = new ddLinkedField(
			jqCustom.find("input#customBankAcctNbr"),
			jqSystem.find("input#en__field_supporter_bankAccountNumber"),
			{
				isRequired: true,
				rememberValue: false,
				validatePattern: Pattern.AT_LEAST_NUMERIC,
				validateHint: "Please enter at least 1 digit",
				useEmptyValue: "0",
			}
		);
		var bankAcctTypeChecking = new ddLinkedField(
			jqCustom.find("input#customBankAcctType_Checking"),
			jqSystem.find("input#en__field_supporter_bankAccountType0"),
			{
				rememberValue: true,
			}
		);
		var bankAcctTypeSavings = new ddLinkedField(
			jqCustom.find("input#customBankAcctType_Savings"),
			jqSystem.find("input#en__field_supporter_bankAccountType1"),
			{
				rememberValue: true,
			}
		);
		var bankOptInField = new ddLinkedField(
			jqCustom.find("input#customBankOptIn"),
			jqSystem.find("input#en__field_transaction_bankname"),
			{
				isRequired: true,
				rememberValue: true,
				validateToTrue: true,
			}
		);
		*/

		var submitButton = new ddLinkedSubmit(
			jqCustom.find("div.button.mainSubmit"),
			jqSystem.find("div.en__submit button"),
			{
				textWhenLocked: '<p class="big">&nbsp;&nbsp;Processing&hellip;&nbsp;&nbsp;</p>',
				callLightboxOnSubmit: true,
			}
		);

		/* delay setup for anything not time-sensitive */
		setTimeout(function() {
			jqCustom.find("div.mainSection.payment input[name=groupPayType]").click(function() {
				setPayType(jqdd(this).val());
			});

			jqCustom.find("div.mainSection.payment input#customCardNbr").keyup(function() {
				setCardMerchant();
			});
			jqCustom.find("div.mainSection.payment input#customCardNbr").change(function() {
				setCardMerchant();
			});
			if (mwdspace.multiStepMode) {
				jqCustom
					.find("div.sectionJump .clickLink, div.actionContainer div.button")
					.click(function() {
						var targetId = jqdd(this).attr("data-target-id");
						if (targetId) {
							goToStep(targetId, "nav");
						}
					});
			}

			try {
				if (localStorage.globalTestMode) {
					var testEmail = String(localStorage.globalTestMode).match(/.+@.+\.\w+/)
						? localStorage.globalTestMode
						: "dd.donordigital@gmail.com";
					logIt.log("testEmail set to", testEmail);

					jqCustom.find("input#customEmail").dblclick(function() {
						jqCustom
							.find("input#customFirstName")
							.val("Donor")
							.trigger("change");
						jqCustom
							.find("input#customLastName")
							.val("Digital")
							.trigger("change");
						jqCustom
							.find("input#customEmail")
							.val(testEmail)
							.trigger("change");
						jqCustom
							.find("input#customStreet")
							.val("2550 Ninth St, Ste 103")
							.trigger("change");
						jqCustom
							.find("input#customCity")
							.val("Berkeley")
							.trigger("change");
						jqCustom
							.find("select#customRegion_XXX")
							.val("CA")
							.trigger("change");
						jqCustom
							.find("input#customZip")
							.val("94710")
							.trigger("change");
						jqCustom
							.find("input#customCardNbr")
							.val("4111111111111111")
							.trigger("change");
						jqCustom
							.find("input#customCardCvv")
							.val("1111")
							.trigger("change");
						jqCustom
							.find("select#customCardExpireMonth")
							.val("12")
							.trigger("change");
						jqCustom
							.find("select#customCardExpireYear")
							.val("20")
							.trigger("change");
						jqCustom
							.find("input#customBankRoutingNbr")
							.val("999999999")
							.trigger("change");
						jqCustom
							.find("input#customBankAcctNbr")
							.val("123456")
							.trigger("change");
					});
					jqSystem.show();
				}
			} catch (err) {
				logIt.warn(err.name, err.message);
			}

			setInterval(checkForClientSideErrors, 2000);
			//preload card feedback icons (defined in stylesheet)
			preloadImage(
				"https://acb0a5d73b67fccd4bbe-c2d8138f0ea10a18dd4c43ec3aa4240a.ssl.cf5.rackcdn.com/10040/icon-invalid-x.svg"
			);
			preloadImage(
				"https://acb0a5d73b67fccd4bbe-c2d8138f0ea10a18dd4c43ec3aa4240a.ssl.cf5.rackcdn.com/10040/icon-valid-check.svg"
			);
		}, 666);

		if (isMonthlyOnlyPage || defaultFrequencyIsMonthly) {
			/* safety radio button set */
			try {
				triggerRecurringMonthly();
				jqSystem.find("input#en__field_transaction_recurrpay1").trigger("click");
				jqSystem
					.find("input#en__field_transaction_recurrpay1")
					.prop("checked", true)
					.trigger("change");
			} catch (e) {
				logIt.warn("CAUGHT ERROR: " + e.message);
			}
		}

		initialLoad = false;
	}
	/* FUNCTIONS */

	function getVisibleRegionObject() {
		try {
			switch (jqCustomCountry.val()) {
				case "US":
					return jqCustom.find("div.inputBox.region select#customRegion_US");
					break;
				case "CA":
					return jqCustom.find("div.inputBox.region select#customRegion_CA");
					break;
				default:
					return jqCustom.find("div.inputBox.region input#customRegion_Open");
			}
		} catch (err) {
			logIt.error("getVisibleRegionObject() caught error: ", err.message);
		}
		return {};
	}

	function showCustomForm(timing) {
		if (typeof timing == "undefined") {
			var timing = 666;
		}
		setTimeout(function() {
			jQuery("div.loadingMessage").hide();
			jqCustom.fadeIn(timing / 2);
		}, timing / 2);
	}

	function goToStep(targetSelect) {
		if (typeof targetSelect === "undefined") {
			var targetSelect = "gift";
		}

		// prevent users from going past gift step with invalid amount
		if (baseGiftAmount < currentMinimumAmount) {
			targetSelect = "gift";
			jqCustom
				.find("input.giftLevel.other")
				.val(baseGiftAmount)
				.trigger("focus")
				.trigger("change");
		}

		// var payMethod = null;
		// if (jqCustom.find("input#customPayMethod_Card").prop("checked")) {
		// 	payMethod = "card";
		// } else if (jqCustom.find("input#customPayMethod_Paypal").prop("checked")) {
		// 	payMethod = "paypal";
		// } else if (jqCustom.find("input#customPayMethod_Bank").prop("checked")) {
		// 	payMethod = "bank";
		// }
		// jqCustom.find("div.staticPayMethodIndicators p.payMethod").removeClass("selected");
		// jqCustom.find("div.staticPayMethodIndicators p.payMethod." + payMethod).addClass("selected");

		switch (targetSelect) {
			case "gift":
				jqdd(
					"div.actionContainer div.button.mainSubmit, div.actionContainer div.button.back"
				).hide();
				jqCustom.find("div.actionContainer div.button.continue").show();
				break;
			case "billing":
				jqCustom.find("div.actionContainer div.button.mainSubmit").hide();
				jqdd(
					"div.actionContainer div.button.continue, div.actionContainer div.button.back"
				).show();
				// switch (payMethod) {
				// 	case "card":
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.card").show();
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.bank").hide();
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.paypal").hide();
				// 		jqdd(
				// 			"div.swapContainer.payFields div.swapFieldGroup.card input, div.swapContainer.payFields div.swapFieldGroup.card select"
				// 		).each(function() {
				// 			jqdd(this).prop("disabled", false);
				// 		});
				// 		jqdd(
				// 			"div.swapContainer.payFields div.swapFieldGroup.bank input, div.swapContainer.payFields div.swapFieldGroup.bank select"
				// 		).each(function() {
				// 			jqdd(this).prop("disabled", true);
				// 		});
				// 		break;
				// 	case "paypal":
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.card").hide();
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.bank").hide();
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.paypal").show();
				// 		jqdd(
				// 			"div.swapContainer.payFields div.swapFieldGroup.card input, div.swapContainer.payFields div.swapFieldGroup.card select"
				// 		).each(function() {
				// 			jqdd(this).prop("disabled", true);
				// 		});
				// 		jqdd(
				// 			"div.swapContainer.payFields div.swapFieldGroup.bank input, div.swapContainer.payFields div.swapFieldGroup.bank select"
				// 		).each(function() {
				// 			jqdd(this).prop("disabled", true);
				// 		});
				// 		break;
				// 	case "bank":
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.card").hide();
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.bank").show();
				// 		jqCustom.find("div.swapContainer.payFields div.swapFieldGroup.paypal").hide();
				// 		jqdd(
				// 			"div.swapContainer.payFields div.swapFieldGroup.card input, div.swapContainer.payFields div.swapFieldGroup.card select"
				// 		).each(function() {
				// 			jqdd(this).prop("disabled", true);
				// 		});
				// 		jqdd(
				// 			"div.swapContainer.payFields div.swapFieldGroup.bank input, div.swapContainer.payFields div.swapFieldGroup.bank select"
				// 		).each(function() {
				// 			jqdd(this).prop("disabled", false);
				// 		});
				// 		break;
				// }
				break;
			case "payment":
				jqCustom.find("div.actionContainer div.button.continue").hide();
				jqdd(
					"div.actionContainer div.button.mainSubmit, div.actionContainer div.button.back"
				).show();
				break;
		}
		jqCustom.find("div.mainSection").hide();
		jqCustom.find("div.mainSection." + targetSelect).fadeIn(444);
		setStoredValue("stepName", targetSelect);
		jqCustom.find("div.sectionJump .clickLink").removeClass("selected");
		jqCustom
			.find("div.sectionJump .clickLink." + targetSelect)
			.addClass("selected visited");
	}

	function buildVisibleGiftstring() {
		var options = {
			basicRounding: true,
			minimumDynamicStart: 30.0,
			minimumGiftAmount: currentMinimumAmount,
		};
		if (storedFreqIsMonthly()) {
			setSystemRecurringMonthly();
			options.useMonthly = true;
			if (!isMonthlyOnlyPage) {
				options.calculateAsMonthly = true;
			}
			if (typeof listMonthlyGiftAskString != "undefined") {
				options.giftStringList = listMonthlyGiftAskString;
			}
			/* show recurring note */
			jqCustom
				.find(".recurringNote")
				.html(
					"Your gift will repeat around the " +
						getDisplayDayOfMonth() +
						" of each month."
				)
				.slideDown(666);
		} else if (storedFreqIsAnnual()) {
			setSystemRecurringAnnual();
			/* show recurring note */
			jqCustom
				.find(".recurringNote")
				.html(
					"Your gift will repeat each year around the " +
						getDisplayDayOfMonth() +
						" of&nbsp;" +
						getDisplayMonth() +
						"."
				)
				.slideDown(666);
		} else {
			setSystemRecurringNone();
			if (typeof listSingleGiftAskString != "undefined") {
				options.giftStringList = listSingleGiftAskString;
			}
			jqCustom.find(".recurringNote").slideUp(333);
		}

		var finalGiftstring = processGiftStringList(options);
		buildGiftLevelButtons(finalGiftstring);
	}

	function getDisplayDayOfMonth(dayOfMonth) {
		if (typeof dayOfMonth == "undefined") {
			var dayOfMonth = new Date().getDate();
		}

		if (dayOfMonth >= 1 && dayOfMonth <= 31) {
			try {
				var suffix =
					["st", "nd", "rd"][((((dayOfMonth + 90) % 100) - 10) % 10) - 1] || "th";
				return "" + dayOfMonth + suffix;
			} catch (err) {}
		}

		return "unknown";
	}

	function getDisplayMonth(month) {
		if (typeof month == "number" && month >= 1 && month <= 12) {
			month -= 1;
		} else {
			var month = new Date().getMonth();
		}
		var names = [
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December",
		];

		return names[month] || "this month";
	}

	function updateGiftAmount(selectedElement) {
		baseGiftAmount = 0.0;
		var newSysAmount;
		jqSystemAmountField.val(0.0);

		var type = selectedElement.prop("tagName").toLowerCase();
		if (type == "div" && selectedElement.hasClass("chooser")) {
			newSysAmount = cleanFloat(selectedElement.html());
		} else if (type == "input" && selectedElement.hasClass("other")) {
			newSysAmount = cleanFloat(selectedElement.val());
		}

		if (newSysAmount) {
			baseGiftAmount = newSysAmount;
		}

		setCurrencyDisplays(currentCurrencySymbol);
		processExtraPercent();
	}

	function processExtraPercent() {
		jqSystemAmountField.val(0.0);
		extraGiftAmount = 0.0;
		if (jqExtraPercent.prop("checked")) {
			var extraPercent = cleanFloat(jqExtraPercent.val());
			if (extraPercent) {
				extraGiftAmount = (extraPercent / 100) * baseGiftAmount;
				var totalAmount = makeTwoDecimal(baseGiftAmount + extraGiftAmount);
				jqCustom
					.find(".totalAmountNote")
					.html(
						"The total including the " +
							extraPercent +
							"% is " +
							totalAmount +
							" " +
							currentCurrencyCode +
							'. <span class="wrapSet">Thank you!</span>'
					);
			} else {
				alert(
					"Sorry! An unexpected error occured while adding the extra percent to the final gift amount."
				);
			}
			setStoredValue("extraPercentEnabled", "true");
		} else {
			var totalAmount = makeTwoDecimal(baseGiftAmount);
			jqCustom
				.find(".totalAmountNote")
				.html(
					"The total is " +
						totalAmount +
						" " +
						currentCurrencyCode +
						'. <span class="wrapSet">Thank you!</span>'
				);
			forgetStoredValue("extraPercentEnabled");
		}
		setSystemAmount();
	}

	function processCurrencyChange() {
		var currencyDetail = getCurrencyInfo(jqCustomCurrency.val()) || null;
		if (!currencyDetail) {
			alert("Sorry! An error occured while handling the selected currency.");
			return;
		}
		currentMinimumAmount = currencyDetail.minimumAmount || MINIMUM_DONATION_AMOUNT;
		currentCurrencyCode = currencyDetail.code || null;
		currentCurrencySymbol = currencyDetail.symbol || null;
		if (currentCurrencySymbol) {
			setCurrencyDisplays(currentCurrencySymbol);
		} else {
			alert("Sorry! Unable to properly display the currency symbol.");
		}

		buildVisibleGiftstring();
		if (currencyDetail.countryCode) {
			jqCustom
				.find("select#customCountry")
				.val(currencyDetail.countryCode)
				.trigger("change");
		}
		processExtraPercent();
	}

	function setCurrencyDisplays(symbol) {
		if (typeof symbol == "undefined") {
			var symbol = "";
		}
		if (!symbol) {
			symbol = "[?]";
		}
		jqCustom.find(".currencyDisplaySymbol").html(symbol);
	}

	function setSystemAmount() {
		var systemAmount = makeTwoDecimal(baseGiftAmount + extraGiftAmount);
		jqSystemAmountField.val(systemAmount);
		/*remember user selected amount in case of possible page reloads*/
		if (storedFreqIsMonthly()) {
			setStoredValue("payAmountMonthly", baseGiftAmount);
		} else if (storedFreqIsAnnual()) {
			setStoredValue("payAmountAnnual", baseGiftAmount);
		} else {
			setStoredValue("payAmountOnce", baseGiftAmount);
		}
	}

	function storedFreqIsMonthly() {
		return getStoredValue("groupGiftFreq_radioGroup") == "customGiftFreq_Monthly";
	}

	function storedFreqIsAnnual() {
		return getStoredValue("groupGiftFreq_radioGroup") == "customGiftFreq_Annual";
	}

	function buildGiftLevelButtons(theList) {
		var preselectFound = false;
		var defaultFound = false;
		var defaultPosition = 1;

		var previousAmt = null;
		if (storedFreqIsMonthly() && getStoredValue("payAmountMonthly")) {
			previousAmt = makeTwoDecimal(getStoredValue("payAmountMonthly"));
		} else if (storedFreqIsAnnual() && getStoredValue("payAmountAnnual")) {
			previousAmt = makeTwoDecimal(getStoredValue("payAmountMonthly"));
		} else if (
			!storedFreqIsMonthly() &&
			!storedFreqIsAnnual() &&
			getStoredValue("payAmountOnce")
		) {
			previousAmt = makeTwoDecimal(getStoredValue("payAmountOnce"));
		}
		if (previousAmt == 0) {
			previousAmt = null;
		}

		jqCustomGiftString.html(""); //clear current string
		var i = 0;
		var displayValue, actualValue;
		for (i = 0; i < theList.length; i++) {
			displayValue = String(theList[i]).replace(/\$/, "");
			displayValue = displayValue.replace(/(\*)|(\.00$)/g, ""); //remove any asterisks or trailing ".00"
			actualValue = makeTwoDecimal(theList[i]);
			/* create FIXED VALUE RADIO, skip if value 0 or less */
			if (actualValue > 0) {
				//set the checked attribute for the default amount, one time only
				if (!preselectFound) {
					if (previousAmt == actualValue) {
						preselectFound = true;
						defaultPosition = i;
					} else if (!defaultFound && theList[i].indexOf("*") > 0) {
						defaultFound = true;
						defaultPosition = i;
					}
				}
				jqCustomGiftString.append(
					'<div class="widthSizer"><div class="giftLevel chooser button" data-dd-amount="' +
						actualValue +
						'"><span class="currencyDisplaySymbol">' +
						currentCurrencySymbol +
						"</span>" +
						displayValue +
						"</div></div>"
				);
			}
		}
		/* create CUSTOM RADIO + text */
		otherActual = "";
		otherDisplay = "";
		if (previousAmt && !preselectFound) {
			defaultPosition = i;
			otherActual = previousAmt;
			otherDisplay = makeTwoDecimal(previousAmt);
		}
		jqdd(jqCustomGiftString).append(
			'<div class="widthSizer fullWidth"><div class="inputOther"><div class="currencyDisplaySymbol">$</div><input type="text" class="giftLevel other" data-dd-amount="' +
				otherActual +
				'" placeholder="or enter amount" value="' +
				otherDisplay +
				'"></div></div>'
		);

		var actualSelected = {};

		/* pre-select an amount based on findings above, or based on URL arguments */
		if (listUrlArgs.ask_selected && listUrlArgs.ask_selected == "other") {
			actualSelected = jqCustom.find(
				"div#customGiftString div.widthsizer input.giftLevel.other"
			);
			actualSelected.focus();
		} else {
			selectedContainer = jqCustom
				.find("div#customGiftString div.widthSizer")
				.eq(defaultPosition);
			actualSelected = selectedContainer.find("div.giftLevel.chooser.button");
			if (actualSelected.length != 1) {
				actualSelected = selectedContainer.find("input.giftLevel.other");
			}
		}
		if (actualSelected.length == 1) {
			jqCustom
				.find("div.button.giftLevel.chooser, div.inputOther")
				.removeClass("selected");
			if (actualSelected.hasClass("other")) {
				actualSelected.closest("div.inputOther").addClass("selected");
				actualSelected.focus();
			} else {
				actualSelected.addClass("selected");
			}
			updateGiftAmount(actualSelected);
		} else {
			logIt.warn("NO GIFT LEVELS FOUND TO PRE-SELECT");
		}

		/* set up change events for the new fields */
		//the fixed radio buttons only
		jqCustom.find("div.button.giftLevel.chooser").click(function() {
			jqCustom
				.find("div.button.giftLevel.chooser, div.inputOther")
				.removeClass("selected");
			jqdd(this).addClass("selected");
			updateGiftAmount(jqdd(this));
			jqCustom
				.find("div.mainSection.gift div.inputOther")
				.removeClass(fieldLinkClasses.INVALID);
			jqCustom.find("div.mainSection.gift div.otherMsg").fadeOut(666);
		});
		//the other entry input only
		jqCustom.find("input.giftLevel.other").on("focus keyup paste", function(event) {
			jqCustom
				.find("div.button.giftLevel.chooser, div.inputOther")
				.removeClass("selected");
			jqdd(this)
				.closest("div.inputOther")
				.addClass("selected");
			updateGiftAmount(jqdd(this));
		});
		jqCustom.find("input.giftLevel.other").on("change", function(event) {
			var container = jqdd(this).closest("div.inputOther");
			var cleanNbr = makeTwoDecimal(jqdd(this).val());
			jqdd(this).val(cleanNbr);
			if (!container.hasClass("selected") || cleanNbr >= currentMinimumAmount) {
				container.removeClass(fieldLinkClasses.INVALID);
				jqCustom
					.find("div.mainSection.gift div.otherMsg")
					.finish()
					.fadeOut(666);
			} else {
				container.addClass(fieldLinkClasses.INVALID);
				jqCustom
					.find("div.mainSection.gift div.otherMsg")
					.html(
						"The amount must be at least " +
							currentMinimumAmount +
							"&nbsp;" +
							currentCurrencyCode
					)
					.finish()
					.fadeIn(666, function() {
						scrollAll(jqCustom.find("div.otherMsg"));
					});
				var thisObject = jqdd(this);
				setTimeout(function() {
					thisObject.focus().select();
				}, 111);
			}
		});
	}

	function buildTyContent(htmlSystemTy) {
		jqCustom.find("div.mainContent").addClass("tyMode");
		var jqIntroContent = jqCustom.find("div.introContent");
		jqIntroContent.html(htmlSystemTy);

		var recurringFrequency =
			jqSystem
				.find("div.transactionData input[name=transactionRecurringFrequency]")
				.val() || "";
		if (recurringFrequency.match(/month/i)) {
			// show recurring note
			var note = "Your gift will repeat";
			var recurringDay = parseInt(
				jqSystem.find("div.transactionData input[name=transactionRecurringDay]").val()
			);
			// report the day with a general fallback
			if (recurringDay > 0) {
				note += " on the " + getDisplayDayOfMonth(recurringDay) + " of each month.";
			} else {
				note += " monthly.";
			}
			jqIntroContent.append("<p>" + note + "</p>");
		} else if (recurringFrequency.match(/annual/i)) {
			// show recurring note
			var note = "Your gift will repeat";
			var recurringDay = parseInt(
				jqSystem.find("div.transactionData input[name=transactionRecurringDay]").val()
			);
			// report the day/month with a general fallback
			if (recurringDay > 0) {
				note +=
					" each year around the " +
					getDisplayDayOfMonth(recurringDay) +
					" of " +
					getDisplayMonth() +
					".";
			} else {
				note += " annually.";
			}
			jqIntroContent.append("<p>" + note + "</p>");
		}
	}

	function recordTransaction() {
		try {
			if (typeof ABTastyClickTracking != "function") {
				/* no action needed bc AB tasty not on this page */
				return;
			}
			var jqData = jqdd("div.transactionData");

			var transactionId = jqData.find("input[name='transactionId']").val();
			var transactionAmount = jqData.find("input[name='transactionAmount']").val();
			var transactionCurrency = jqData.find("input[name='transactionCurrency']").val();
			var transactionRecurringFrequency =
				jqData.find("input[name='transactionRecurringFrequency']").val() || "";

			var isMonthly = transactionRecurringFrequency.match(/month/i);

			if (isMonthly === null) {
				ABTastyClickTracking("Single Gift", null, 433662);
			} else {
				ABTastyClickTracking("Monthly Gift", null, 433662);
			}

			/* Send the transaction ID and total to our data collection servers  */
			window._abtasty.push([
				"transaction",
				"Donated",
				transactionId,
				transactionAmount,
				1,
			]);
		} catch (e) {
			if (window.console) console.warn("Error recording transaction: ", e.message);
		}
	}

	function initFrequencyElements() {
		if (isMonthlyOnlyPage) {
			// no change event and only show monthly
			jqCustomGiftFreq.find("label.giftFreq").hide();
			triggerRecurringMonthly();
			jqCustom
				.find("div.mainSection.gift .sectionHeading")
				.html("Select your monthly gift amount");
		} else {
			/* init as either single, monthly, annual */
			if (
				storedFreqIsMonthly() ||
				(defaultFrequencyIsMonthly &&
					getStoredValue("groupGiftFreq_radioGroup") === null)
			) {
				triggerRecurringMonthly();
				setSystemRecurringMonthly();
			} else if (
				addAnnualRecurring &&
				(storedFreqIsAnnual() ||
					(defaultFrequencyIsAnnual &&
						getStoredValue("groupGiftFreq_radioGroup") === null))
			) {
				triggerRecurringAnnual();
				setSystemRecurringAnnual();
			} else {
				triggerRecurringNone();
				setSystemRecurringNone();
			}

			/* create change events */
			jqCustomGiftFreq.find('input.giftFreq[type="radio"]').change(function() {
				buildVisibleGiftstring();
			});
		}
	}

	function triggerRecurringNone() {
		jqCustomGiftFreq
			.find("input#customGiftFreq_Single")
			.prop("checked", true)
			.trigger("change");
	}

	function triggerRecurringMonthly() {
		jqCustomGiftFreq
			.find("input#customGiftFreq_Monthly")
			.prop("checked", true)
			.trigger("change");
	}

	function triggerRecurringAnnual() {
		jqCustomGiftFreq
			.find("input#customGiftFreq_Annual")
			.prop("checked", true)
			.trigger("change");
	}

	function setSystemRecurringNone() {
		jqSystem.find("input[name='transaction.recurrfreq']").val("NONE");
	}

	function setSystemRecurringMonthly() {
		jqSystem.find("input[name='transaction.recurrfreq']").val("MONTHLY");
	}

	function setSystemRecurringAnnual() {
		jqSystem.find("input[name='transaction.recurrfreq']").val("ANNUAL");
	}

	// function setPaymentSystemInfo(thisElement) {

	// 	var thisId = thisElement.attr("id");
	// 	thisElement.addClass("selected");
	// 	setStoredValue("payMethodSelectionId", thisId);

	// 	// currently no bank or paypal
	// 	if (jqCustom.find("input#customPayMethod_Bank").prop("checked")) {
	// 		selectSystemPayTypeField(PayType.BANK_ACCT);
	// 		setStoredValue("payType_", PayType.BANK_ACCT);
	// 	} else if (jqCustom.find("input#customPayMethod_Paypal").prop("checked")) {
	// 		selectSystemPayTypeField(PayType.PAYPAL);
	// 		setStoredValue("payType_", PayType.PAYPAL);
	// 	} else {
	// 		setCardMerchant();
	// 	}
	// }

	function setCardMerchant() {
		var merchant = guessCardMerchant(jqCustom.find("input#customCardNbr").val());
		switch (merchant) {
			case PayType.VISA:
				jqCustom
					.find("div.mainSection.payment input#customPayType_visa")
					.prop("checked", true);
				setPayType(merchant);
				break;
			case PayType.MASTERCARD:
				jqCustom
					.find("div.mainSection.payment input#customPayType_mastercard")
					.prop("checked", true);
				setPayType(merchant);
				break;
			case PayType.AMEX:
				jqCustom
					.find("div.mainSection.payment input#customPayType_amex")
					.prop("checked", true);
				setPayType(merchant);
				break;
			case PayType.DISCOVER:
				jqCustom
					.find("div.mainSection.payment input#customPayType_discover")
					.prop("checked", true);
				setPayType(merchant);
				break;

			default:
				resetPayType();
		}
	}

	function setPayType(payType) {
		switch (payType) {
			case PayType.VISA:
				selectSystemPayTypeField("visa");
				break;
			case PayType.MASTERCARD:
				selectSystemPayTypeField("mc");
				break;
			case PayType.AMEX:
				selectSystemPayTypeField("amex");
				break;
			case PayType.DISCOVER:
				selectSystemPayTypeField("discover");
				break;
			// case PayType.BANK_ACCT:
			// 	selectSystemPayTypeField("acheft");
			// 	break;
			// case PayType.PAYPAL:
			// 	selectSystemPayTypeField("paypal");
			// 	break;
			default:
				resetPayType();
				return;
		}

		setStoredValue("payType_", payType);
	}

	function resetPayType() {
		//unset the visual field
		jqCustom.find("div.mainSection.payment input[name=groupPayType]").each(function() {
			jqdd(this).prop("checked", false);
		});

		// unset the system field
		jqSystem.find('div.en__field--paymenttype input[type="radio"]').each(function() {
			jqdd(this).prop("checked", false);
		});
		forgetStoredValue("payType_");
	}

	function selectSystemPayTypeField(targetValue) {
		var targetRadio = jqdd(
			'div.en__field--paymenttype input[type=radio].en__field__input--radio[value="' +
				targetValue +
				'"]'
		);
		targetRadio.prop("checked", true);
		if (targetRadio.length != 1) {
			logIt.warn("selectSystemPayTypeField(): Pay type radio not found:", targetValue);
		}
	}

	function getCurrentSystemPayTypeObject() {
		var selectedObject = jqdd();
		jqSystem
			.find("div.en__field--paymenttype input[type=radio].en__field__input--radio")
			.each(function() {
				if (jqdd(this).prop("checked")) {
					selectedObject = jqdd(this);
					return false; //break jq loop
				}
			});
		return selectedObject;
	}

	function getCmsSystemGiftAmount() {
		return parseFloat(jqSystem.find("input#en__field_transaction_donationAmt").val()) || 0;
	}

	function get2DigitMonth(input) {
		if (typeof input == "undefined") {
			var input = "";
		}
		if (!input) {
			input = new Date().getMonth();
			input++;
		}
		var month = "" + input;
		if (month.length == 1) {
			return "0" + month;
		} else if (month.length == 2) {
			return month;
		}
		return month;
	}

	/* User message is in alert color, below the submit button */
	function addUserMessage(input) {
		var messages = [];
		if (typeof input == "string") {
			messages.push(input);
		} else if (typeof input == "object" && input.length > 0) {
			messages = input;
		} else {
			logIt.warn("addUserMessage() given invalid input", input);
		}

		var thisMessage;
		for (var i = 0; i < messages.length; i++) {
			thisMessage = "" + messages[i];
			if (thisMessage.trim()) {
				jqUserMessage.append("<p>" + thisMessage + "</p>");
			}
		}

		jqUserMessage.slideDown(333, function() {
			scrollAll(jqUserMessage);
		});
	}

	function resetUserMessage() {
		jqUserMessage.hide().html("");
	}

	function checkForClientSideErrors() {
		var userMessages = [
			"<strong>Please correct the following issues and submit again:</strong>",
		];

		jqSystem
			.find("div.en__component.en__component--formblock div.en__field__error")
			.each(function() {
				if (!jqdd(this).hasClass("mwdErrorProcessed")) {
					var messageText = jqdd(this).html() || "";
					if (messageText.trim()) {
						userMessages.push(messageText);
						jqdd(this).addClass("mwdErrorProcessed"); //clear the system text
					}
				}
			});

		if (userMessages.length > 1) {
			// pass system messages to user
			addUserMessage(userMessages);
			submitButton.unlock();
		}
	}

	function processCardNumberInput(targetObject, event) {
		// remove non-digit chars
		var newValue = targetObject.val() || "";
		var cleaned = newValue.replace(/\D/g, "");
		if (cleaned !== newValue) {
			targetObject.val(cleaned);
		}
		setTimeout(updateCardInputFeedback, 1);
	}

	function updateCardInputFeedback() {
		var value = jqCardNumberInput.val() || "";

		if (validateCardNumber(value)) {
			jqCardNumberInput
				.removeClass("iconFeedbackInvalid")
				.addClass("iconFeedbackValid")
				.attr("title", "This card number looks good");
			cardNbrField.validate();
		} else {
			jqCardNumberInput
				.removeClass("iconFeedbackValid")
				.addClass("iconFeedbackInvalid")
				.attr("title", "You may have mistyped some of the numbers for this card");
		}
	}

	// validate using Luhn algorithm
	function validateCardNumber(input) {
		try {
			if (typeof input == "undefined") {
				var input = "";
			}

			// basic validation
			if (!input || /[^0-9-\s]+/.test(input)) return false;
			input = String(input).replace(/\D/g, "");
			if (input.length < 15 || input.length > 16) return false;

			// Luhn algorithm
			var checkSum = 0;
			var isEven = false;

			for (var i = input.length - 1; i >= 0; i--) {
				var thisDigit = parseInt(input.charAt(i), 10);
				if (isEven) {
					if ((thisDigit *= 2) > 9) thisDigit -= 9;
				}
				checkSum += thisDigit;
				isEven = !isEven;
			}

			return checkSum % 10 == 0;
		} catch (e) {
			return null;
		}
	}

	function preloadImage(url) {
		try {
			var preload = new Image();
			preload.src = url;

			if (!mwdspace.preloadedImageStore) {
				mwdspace.preloadedImageStore = [];
			}
			mwdspace.preloadedImageStore.push(preload);
		} catch (e) {
			logIt.warn("preloadImage() caught: " + e.message);
		}
	}

	/* indicate successful code completion */
	jqSystem.hide().removeClass("startFail");
}); /*end READY*/