# Sass
An extension of CSS, adding nested rules, variables, mixins, selector inheritance, and more. It's translated to well-formatted, standard CSS using the command line tool or a web-framework plugin.

### Variables 
  - let you define and reuse values throughout the stylesheet.

```
// declare a variable
$font-serif: Jubilat, Georgia, serif;

// use a variable
em {
  font: $font-serif;
}

// which will compile to
em {
  font: Jubilat, Georgia, serif;
}
```

### Mixins 
  - allow you to define and reuse blocks of styles.

```
// declare a mixin
@mixin title-style {
  margin: 0 0 20px 0;
  font-family: $font-serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
}

// use a mixin
section.main h2 {
  @include title-style;
}

// which will compile to
section.main h2 {
  margin: 0 0 20px 0;
  font-family: Jubilat, Georgia, serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
}

// mixing can be included with additional rules as well
section.secondary h3 {
  @include title-style;
  color: #999;
}
```

##### Mixin Arguments 
  - Sass mixins can also take arguments that we pass to the mixin when we call it.

```
// specify arguments with variables inside parentheses when defining the mixing
@mixin title-style($color) {
  margin: 0 0 20px 0;
  font-family: $font-serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase; 
  color: $color;
}

// when calling the mixing, we can now pass a color to it
section.main h2 {
  @include title-style(#c63);
}

// which will compile to
section.main h2 {
  margin: 0 0 20px 0;
  font-family: Jubilat, Georgia, serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: #c63;
}

// you can pass multiple arguments by separating the values with commas in the mixing definition
@mixin title-style($color, $background) {
  margin: 0 0 20px 0;
  font-family: $font-serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: $color;
  background: $background;
}

// here is the mixin being called from two different selectors
section.main h2 {
  @include title-style(#c63, #eee);
}
section.secondary h3 {
  @include title-style(#39c, #333);
}

//which compiles to
section.main h2 {
  margin: 0 0 20px 0;
  font-family: Jubilat, Georgia, serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: #c63;
  background: #eee;
}
section.secondary h3 {
  margin: 0 0 20px 0;
  font-family: Jubilat, Georgia, serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: #39c;
  background: #333;
}

// defining defaults for arguments
@mixin title-style($color, $background: #eee) {
  margin: 0 0 20px 0;
  font-family: $font-serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: $color;
  background: $background;
}

// an argument can still be passed to over-write the default.
section.main h2 {
  @include title-style(#c63);
}
section.secondary h3 {
  @include title-style(#39c, #333);
} 

// compiles to
section.main h2 {
  margin: 0 0 20px 0;
  font-family: Jubilat, Georgia, serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: #c63;
  background: #eee;
}
section.secondary h3 {
  margin: 0 0 20px 0;
  font-family: Jubilat, Georgia, serif;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  color: #39c;
  background: #333;
}
```

### Nesting
  - Use nesting properly, and not wastefully. Don't forget the parent selector &. Try not to nest more than a few deep (a common rule of thumb to avoid specificity complications, google stuff like "SCSS nesting specificity" and I'm sure it will be explained)

```
.banner {
  padding: 3% 2%;
  border-bottom: 1px solid black;
  h1 {
    color: #444;
    text-align: center;
    em {
      opacity: 0.5;
    }
  }
}

.navbar {
  a {
    color: blue;
    text-decoration: none;
    &:visited { color: rebeccapurple; }
    &:hover, &:focus { color: cyan; }
    &:active { color: dodgerblue; }
    &.current { text-decoration: underline; } // when the <a> element has the "current" class applied
    ul & { display: inline-block; } // example of how you can put things before the parent selector
  }
}
```

### Variables
  - Use variables, especially for colors, and use color functions. I don't like the variable name to actually describe the color, but rather what the color is supposed to 'mean' -- that is, if the actual color is changed, you don't want to have to change the variable too (good: $color-highlight. bad: $color-bright-orange).

```
$color-background: slategrey;
$color-plate: gainsboro;
$color-highlight: lime;

.funbox { // use of color functions
  background-color: lighten($color-plate, 5%);
  border: 1px solid darken($color-highlight, 5%);
}
(4) Use mixins like functions that can take arguments and dynamically generate rules.
@mixin linkify ($linkcolor) {
  color: $linkcolor;
  &:visited { color: darken($linkcolor, 5%); }
  &:hover, &:focus { color: lighten($linkcolor, 5%); }
  &:active { color: lighten($linkcolor, 10%); }
}

.navbar a {
  @include linkify(blue);
}
```

### @extend
  - Use @extend with "Placeholder Selectors" (prefixed by "%") as a means to reuse rules (to avoid repeating yourself). I do this a lot for things like reusable typography styles. The way @extend works is very optimal, so it's a good idea to make much use of it.

```
%type-fancy {
  font-family: "Classy Curls", cursive;
  color: #333;
  line-height: 1.25em;
}

.banner {
  @extend %type-fancy;
  text-align: left;
  font-size: 1.6em;
}

.footer {
  @extend %type-fancy;
  text-align: right;
  font-size: 1.2em;
  color: mix($color-plate, $color-background);
  border-radius: 0 0 4px 4px;
}
```

### Partials
  - Use SCSS "Partials" to separate your SCSS into many files. This matters most in team environments that use version control (like Git): it's ideal to have many files instead of a monolithic one, because version control conflicts are much less frequent and are easier to resolve. Partials are prefixed with an underscore, which indicates to Sass that the file is to be included as SCSS code, instead of compiling it to CSS and importing the old fashioned way (standard CSS import).

```
==== PROJECT DIRECTORY ====

  project/
    index.html
    style.css   # generated css
    style.css.map # source map (recommended)
    style.scss  # main scss file (which imports the partials)

    partials/
      _colors.scss   # $color-* variable declarations
      _typography.scss  # %type-* placeholder selector declarations (@extend-able)
      _breakpoints.scss # media query mixins
      _header.scss
      _plate.scss
      _footer.scss


==== STYLE.SCSS ====

  @import "partials/colors";
  @import "partials/typography";
  @import "partials/breakpoints";
  @import "partials/header";
  @import "partials/plate";
  @import "partials/footer";
```

### Comments
  - There are two types of comments:

```
/* This comment will actually appear in the compiled CSS output */

// This comment will not (it is SCSS only)
```
