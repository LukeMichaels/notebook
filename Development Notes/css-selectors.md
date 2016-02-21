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

