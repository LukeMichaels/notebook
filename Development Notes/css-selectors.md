# CSS Selectors
Notes on some advanced selectors.

### Substring Matching Attribute Selectors
[Attribute Selectors - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/Attribute_selectors)  

  - ^ tells the browser to match a piece of code that’s at the beginning of an attribute's value

```
// [attr^=value]
// Represents an element with an attribute name of attr and whose value is prefixed by "value".
// All internal links have a gold background
a[href^="#"] {background-color:gold}
```

  - $ matches a piece at the end of an attribute's value

```
// [attr$=value]
// Represents an element with an attribute name of attr and whose value is suffixed by "value".
// All links to urls ending in ".cn" are red
a[href$=".cn"] {color: red;}
```

  - * matches any part of an attribute's value

```
// [attr*=value]
// Represents an element with an attribute name of attr and whose value contains at least one occurrence of string "value" as substring.
// All links to with "example" in the url have a grey background
a[href*="example"] {background-color: #CCCCCC;}
```

### Element States Pseudo-Classes
[CSS Basics - Pseudo-Classes](http://teamtreehouse.com/library/css-basics-2/basic-selectors/pseudoclasses-3)  
[:disabled - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/:disabled)  
[:checked - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/:checked)  

  - Like user-action pseudo classes, CSS has UI element states pseudo-classes that let us target elements based on user interaction states.

```
//To target a disabled input element, we can write:
input:disabled {
  background-color: grey;
}

//To target a radio button or checkbox when checked, we can write:
:checked {
  border-color: red;
}
```

### :nth-child
[:nth-child - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/:nth-child)  

  - :nth-child is a powerful structural pseudo-class because it targets child elements based on any position inside a parent.

```
// this targets the even li elements in a parent
li:nth-child(even) {
  background: blue;
  color: white;
}

// the index starts at 1 so this will target the 3rd child element
li:nth-child(3) {
  color: black;
}

// here is an advanced use of :nth-child
// a is the cycle of elements to select (after the first is selected)
// n never changes, it's always n
// b is an offset value, if we make it 3, the 3rd item will be the first selected (ignoring all items before it
li:nth-child(an+b) {
  color: white;
}

// here the 3rd value will be selected first, then every 2nd list item will get selected after that
li:nth-child(2n+3) {
  color: white;
}

// negative expressions are acceptable
// here every child element that precedes the 3rd value will be selected (the 3rd value will also be selected)
li:nth-child(-n+3) {
  color: white;
}

// note that there is no need for an a value of 1 or a b value of 0, they can simply be ommitted
```

### :nth-of-type
[:nth-of-type - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/:nth-of-type)  

- The :nth-of-type pseudo-class targets an element based on its position within a parent, but only if it’s a specific type of element.

```
// this selector targets the 4th div inside the parent, no matter what type of child elements come before it
div:nth-of-type(4) {
  background: #52bab3;
  color: white;
}
```
