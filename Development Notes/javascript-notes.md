# JavaScript

## Operators - standard math operators
```
+, -, /, *, %
% (modulus) returns the remainder after division
+= - take variable, add it to value and store back in variable (also works for -=, *=. /=, etc)
++ - increase variables value by 1
— - decrease variables value by 1
```

## Comparators
```
>, <, >=, <=, ==, !=
```

## Strings - How JS stores and processes flat text
```
/t - moves to next tab stop
/n - moves to new line

JS is case sensitive
```

## Methods
```
.charAt() - sentence.charAt(31) would return the character in the 31st position.
```

## Functions 
  - Allow you to pass them info and then give you back something in return. Allow bundling of JS code into reusable modules.
```
alert() - displays a text message in a small pop-up window
  alert(‘text to display’);

Built-in Functions Quick-Ref
alert - pop-up box
confirm - pop-up confirmation box
prompt - pop-up a box and get a value from the user
var - sets aside a storage location for a piece of data
on blur - indicates that the user has moved onto the next input field
value - the current value
onclick - indicates that a button has been clicked
parseInt - converts string to integer
parseFloat - string to float (decimal) number
getElementById - grab form data (technically, this is a method on the document object, and not a function)
isNaN - tells you whether or not the value you pass it is a number
setTimeout(timer code, timer delay); - a one-shot timer
setInterval(timer code, timer delay); - a timer that gets run over-and-over
clearInterval(timerID) - clears an interval timer
pop - gets the last value in an array and removes it
push - add a value to the end of an array
shift - removes the first item from an array
unshift - adds on or more items to the begging of an array
```

## Events 
  - used to respond to web page happenings with JavaScript code.

```
onload 
  <body onload="alert('Hello, I am your pet rock.');">
  - triggered when a page finishes loading
  - you respond to the unload event by setting the unload attribute of the <body> tag

onresize
  <body onresize=“function();”>
```

## Data Types 
  - JS uses three basic data types: text, number and boolean. 
  - The data type is established when the data is set to a certain value.
  - Text (aka strings) - a sequence of characters
  - Number - numeric data, can be integer/whole numbers or decimals
  - Boolean - true or false
  - When numbers and characters are mixed, the data is ALWAYS considered text.

## Data Purpose 
  - Variable data can change - constant data is fixed.

## Variables 
  - A storage location in memory with a unique name.
  - Variable names usually use lower camel case, in which the first word is all lower-case, but additional words are mixed-case.

```
var variableName;
var variableName = Initial Value; (the equals sign connects the variable name to its initial value)
var population = 300; 
```

## Constants 
  - handy for storing information that you might directly code in a script.

```
const ConstantName = Constant Value;
const TAXRATE = .925; (constants are often named using all caps to make them standout from variables)

NaN means Not a Number. It’s a value that isn’t a number even though you’re expecting the value to be one.
```

## Converting text to a number
  - Accidentally concatenating strings when you intend to add numbers is a common JS mistake. Convert strings to numbers before adding them.

```
parseInt() - converts string to integer
parseFloat() converts string to float (decimal)

parseInt(“1”) + parseInt(“2”) = 3
```

## Get Form Data

```
getElementById()
Give this method the ID of an element on a web page and it gives you back the element itself, which can then be used to access web data.

document.getElementById(“donuts”) // The ID is the key to accessing an element.
document.getElementById(“donuts”).value // The value property gives us access to the data.
```

## Timers 
  - allow JavaScript code to run after a certain amount of time has elapsed.
  - establish the time delay
  - let the timer know what code to run

```
Time delay is expressed in milliseconds
setTimeout() is a one-shot timer
setInterval() is a timer than runs over-and-over

setTimeout(timer code, timer delay); 

Don’t ever put commas in a JavaScript number
```

## Client Window Size 
  - The width and height of the client window can be accessed using the body.clientWidth and body.clientHeight properties of the document object.

```
document.body.clientWidth
document.body.clientHeight
```

## Cookies 
  - a piece of text data stored by the browser on the user’s computer.
  - Cookies allow scripts to store data that survives beyond a single web session.
  - Every cookie has an expiration date, after which the cookie is destroyed by the browser.

```
readCookie()
writeCookie()
eraseCookie()

navigator.cookieEnabled - checks to see if the browser supports cookies.
```

## Loops 
  - allow code to be executed repeatedly

#### While-Loop 
  - runs as long as its boolean expression is true

```
while(*some expression is true*){
  *do this code!*
};

// prints the numbers 1-5 in ascending order
var number = 1;
while (number <= 5) {
  console.log(number);
  number++;
}
```

#### For-Loop
  - A for loop consists of four different parts:
    - 1. Initialization - Initialization takes place one time, at the start of a for loop.
    - 2. Test condition - The test condition checks to see if the loop should continue with another cycle.
    - 3. Action - The action part of the loop is the code that is actually repeated in each cycle.
    - 4. Update - The update part of the loop updates any loop variables at the end of a cycle.

```
for( *initialization*; *loop if this expression is true*; *usually ++ or —*) {
  *repeated code*;
}

// prints 1-5 in descending order
for(var number = 5; number > 0; number—){
  console.log(number);
}
```

#### if and else statements 
  - Execute certain code based on specific conditions

```
if (*some condition is true*) {
  *do this code*
} else {
  *OTHERWISE, do this code instead*
}

else if
if (*some condition is true*) {
  *do this code*
} else if (*some OTHER condition is true*){
  *do something for this condition*
} else {
  *IN ALL OTHER CASES, do this code instead*
}
```

#### Switch Statements
  - Enclose the test data in parentheses and open the compound statement ({).
  - Write the case match followed by a colon (:).
  - Write the code that gets run if there is a match. This can be multiple lines of code—there is no need for a compound statement.
  - Add a break statement—don’t forget the semicolon (;).
  - Optionally include a default branch for when there is no match.
  - Close the compound statement (}).

```
switch ( test data ) {     // test data must be a piece of data, not an expression
  case 
    Match 1 : statement;  // each match ends with a regular colon, not semicolon
    break;               // the break statement prevents code for other decisions branches from getting run
  default :             // an optional “default” branch contains code to be run if nothing else matches
    statement;
    break;
} // the entire body of the statement is wrapped up with curly braces


var curScene = 0;
function changeScene(decision) {
         var message = "";
  switch (curScene) {
    case 0 :
       curScene = 1;
      message = "Your journey begins at a fork in the road.";
      break;
    case 1 :
      if (decision == 1) {
        curScene = 2;
        message = "You have arrived at a cute little house in the woods.";
      } else {
        curScene = 3;
        message = "You are standing on the bridge overlooking a peaceful stream.";
      }
    break;
  }
}
```

## Complex Conditionals
  - && - binary and, returns true if both values are true
  - || - binary or, returns true if either value is true

## Arrays 
  - a data structure with automatically indexed positions
  - Just like strings, Arrays have indices that are zero-based.

```
var passengers = [“bill”, “tim”, “greg”];
passengers[2] -> “greg”

passengers.length -> 3

The pop() function deletes the last position and retrieves its value.
passengers.pop(); -> “greg” (greg will be removed from the array)

The push() function adds a cell in the last position and enters a value
passengers.push(“luke”); -> luke gets added to the end and the length is auto increased.

Arrays can hold anything: numbers, strings, variables, etc. Even other Arrays.

Loops with Arrays
var numberList = [ 2, 5, 8, 4, 7];
for (var i = 0; i < numberList.length; i++){
  console.log(“The value in cell “ + i + “ is “ + numberList[1]);
}

We can use length to get the last value in an array.
authors[authors.length-1]
```

## Objects 
  - unordered lists of primitive data (and sometimes reference data types) types that are stored as name-value pairs.

```
var myFirstObject = {firstName: "Richard", favoriteAuthor: "Conrad"};

var ageGroup = {30: "Children", 100:"Very Old"};
console.log(ageGroup.30) // This will throw an error
// This is how you will access the value of the property 30, to get value "Children"
console.log(ageGroup["30"]); // Children

//It is best to avoid using numbers as property names.
```


