# Flexbox
Flexbox is a remarkable layout feature that's redefined how web designers build responsive layouts. With flexbox you can change the direction, size, and order of elements, like navigation links, content columns and images, regardless of their original size and order in the HTML.

## Index
  - I.    Resources
  - II.   Terminoligy
  - III.  The Flexbox Layout
  - IV.   Examples

## I.    Resources
[A Complete Guide to Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)  
[A Visual Guide to CSS3 Flexbox Properties](https://scotch.io/tutorials/a-visual-guide-to-css3-flexbox-properties)  
[Flexbox Cheat Sheet](http://www.sketchingwithcss.com/samplechapter/cheatsheet.html)  
[Flexbox Playground](https://scotch.io/demos/visual-guide-to-css3-flexbox-flexbox-playground)  
[Flexbox - latest browser support](http://caniuse.com/#search=flexbox)  
[Flexbox Froggy - fun way to practice](http://flexboxfroggy.com/)  
[Flexbugs - community curated list of flexbox issues and cross-browser workarounds](https://github.com/philipwalton/flexbugs)  


## II.   Terminoligy
### Flex Container
  - Sets the context for flexbox layout
  - Contains flex items, the actual elements you layout using flex box
  - Can be any block-level or inline element

### Flex Item
  - Every direct child of a flex container
  - There can be any number of flex items inside of a flex container

### Flexbox Axes
  - Main axis: primary access, defines direction of flex-items, default is left to right
  - Cross axis: runs perpendicular to main access, default is top to bottom


## III.  The Flexbox Layout
### Establish the flex formatting context
```
// by default this creates a block-level flex container
// items inside will be laid out in a row from left to right, taking up the full height of the div
.container {
   display: flex;
}

// a flex container can also be inline (wont fill an entire row)
display: inline-flex;
```

### Use "flex-direction" to establish the flow of the content
[flex-direction - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/flex-direction)  

  - Some flexbox properties apply to the flex container only, while some apply only to the flex items.
  - The flex-direction property applies to the flex container only.
  - The default value for flex-direction is row.
  - To reverse the direction flex items in a row, use the value row-reverse.
  - The value column rotates the main axis so that flex items are laid out vertically.
  - Like the row-reverse property, you can swap the top-to-bottom direction of a column with the value column-reverse.

```
// this is the default, items are displayed horizontally from left to right
.container {
  display: flex;
  flex-direction: row;
}

// this will align the content horizontally, and in reverse order (right to left)
flex-direction: row-reverse;

// column will cause the content to flow vertically instead of horizontally
flex-direction: column;

// same as row-reverse, but from bottom to top
flex-direction: column-reverse;
```

### Control whether flex-container is a single or multi-line layout with "flex-wrap"
[flex-wrap - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/flex-wrap)  

  - The flex-wrap property is for flex containers only.
  - The flex container lays out flex items on a single line called a flex line.
  - The flex container tries to fit all items on one flex line, even if causes its contents to overflow.
  - The flex container can break flex items into multiple flex lines and allow them to wrap as needed.
  - With the flex-wrap property, you can control whether the flex container is a single-line or multi-line layout.
  - The value wrap breaks the flex items into multiple lines.

```
// this will make content wrap to the next line when there isn't enough room to display items on one
.container {
   display: flex;
   flex-wrap: wrap;
}  

// default single-line, left to right
flex-wrap: nowrap;

// multi-line, right to left
flex-wrap: wrap-reverse;
```

### Control the position and alignment of items on the main access and how space should be distributed using "justify-content"
[justify-content - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/justify-content)  

  - You apply the justify-content property to flex containers only.
  - The justify-content property lets you control the position and alignment of flex Items on the main axis and how space should be distributed in a flex container.
  - The default value for justify-content is flex-start, which places items towards the start of each flex line.
  - To place items at the end of the flex line, set justify-content to flex-end.
  - The value center places flex items in the center of the line, with equal amounts of empty space between the line's start edge and the first item.
  - The value space-between displays equal spacing between flex items.
  - For equal spacing around every flex item, use the value space-around.
  - A margin set to auto will absorb any extra space around a flex item and push other flex items into different positions.

```
// this aligns flex items to the end of the flex line
.container {
   display: flex;
   justify-content: flex-end;
}  

// default - items are placed at the beginning of the flex line
justify-content: flex-start'

// items are centered along the line
justify-content: center;

// items are evenly distributed in the line with the first item at the start and last item at the end of the line
justify-content: space-between;

// items are evenly distributed in the line with equal space around them
justify-content: space-around;
```

<img src="images/flexbox/justify-content-example.png" alt="justify-content-example" width="1020" height="76" /> 
```
// in this example, "item-1" will be positioned all the way to the left,
// all other items will position to the right with equal space between them.
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}  
.item-1 {
   margin-right: auto;
}
```

### Control the order of flex-items with "order"
[order - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/order)  

  - The order property applies to flex items only.
  - We can use the order property to change the order of any flex item.
  - You can structure an HTML document for SEO or accessibility first, then rearrange the content without ever editing the HTML.
  - The default order of all flex items is 0.
  - order places flex items relative to the other items' order values.
  - To place a flex item before another item, it needs to have a lower order value than the item.
  - To place a flex item after another item, it needs to have a higher order value than the item.

```
// this would move "item-1" to then end of the list  
.item-1 {
   order: 1;
}

// you can use negative values with order  
// here "item-1" will be first, then "item-5", then the rest of the items in the list  
.item-1 {  
  order: -2;
}
.item-5 {
  order: -1;
}
```

### With "flex-grow" we can make items grow and shrink in relation to other items in the container
[flex-grow MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/flex-grow)  
[flex-grow is it weird. Or is it?](https://css-tricks.com/flex-grow-is-weird/)  

  - The flex-grow property applies to flex items only.
  - flex-grow determines how much of the available space inside the flex container an item should take up; it assigns more or less space to flex items.
  - A flex-grow value of 1 expands flex items to take up the full space of a line.
  - The higher the flex-grow value, the more an item grows relative to the other items.

```
// here "item-3" will take up 3x the amount of space as other items (1 is the default value)
.container {
  display: flex;
  flex-wrap: wrap;
}  
.item {
  flex-grow: 1;
}
.item-3 {
  flex-grow: 3;
}
```

### The "flex-basis" property provides further control over the size of flex items
[flex-basis - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/flex-basis)  
[flex-shrink - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/flex-shrink)  

  - flex and flex-basis apply to flex items only.  
  - flex-basis specifies the initial main size of a flex item.  
  - You set the initial size you want the flex items to be, then flexbox evenly distributes the free space according that size.  
  - flex is the shorthand for flex-grow, flex-basis and flex-shrink.  
  - Using only one number value for flex sets the flex-grow value of an item.  

```
// flex-basis works with flex-grow to display even but flexible widths  
// here flex items will display at an equal size when 200px or wider  
.container {  
  display: flex;  
  flex-wrap: wrap;  
}  
.item {  
  flex-grow: 1;  
  flex-basis: 200px;  
}  
```

  - flex-shrink is the opposite of flex-grow  
  - flex is a shorthand property for flex-grow, flex-basis and flex-shrink  
  - The second and third values are optional in the flex shorthand.  
  - Setting only one number value for flex automatically sets the flex-basis value to 0.  

```  
// the first value is for flex-grow, so here the item is getting set to flex-grow: 1 and because the default is 0 and we didn't provide anything, flex-basis is set to 0  
.item {  
  flex: 1;  
}  

// here flex-grow is 1 and flex-basis is 200px  
item {  
  flex: 1 200px;  
}  
```

### Align items on the cross axis with the "align-items" property
[align-items MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/align-items)  

  - The align-items property applies to flex containers only.  
  - The align-self property applies to flex items only.  
  - align-items aligns flex items vertically in the flex container.  
  - To align all flex items to the start of the cross axis, use the align-items: flex-start;.  
  - align-items: flex-end; packs the items toward the end of the cross axis.  
  - align-items: center; perfectly centers items along the cross axis.  

```
// by default align-items is set to stretch, which makes flex-items equal height.
.container {
  display: flex;
  flex-wrap: wrap;
  height: 450px;
  align-items: stretch;
}

// flex-start packs the items at the beginning of the cross axis
align-items: flex-start;


// flex-end packs the items at the end of the cross axis
align-items: flex-end;


// center aligns items in the center of the flex axis
align-items: center;

```

### Align individual items (on the cross axis) with the "align-self" property
[align-self MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/align-self)  

  - align-self: flex-start; aligns a flex item to the start of the cross axis.  
  - align-self: flex-end; aligns a flex item to the end of the cross axis.  
  - align-self: center; aligns a flex item to the center of the cross axis.  

```
// here only ".item-1" is aligned to the start of the cross axis, other items are aligned "stretch"
.container {
  display: flex;
  flex-wrap: wrap;
  height: 450px;
  align-items: stretch;
}
.item {
  flex: 1;
}
.item-1 {
  align-self: flex-start;
}
.item-2 {
  flex: 2;
}
```

### Vertical and Horizontal Centering with flexbox

```
// three ways to center-align elements using flexbox

// set the flex container's justify-content and align-items values to center:
.container {
  justify-content: center;
  align-items: center;
}

// set the flex container's justify-content value to center, while setting the flex item's align-self value to center:
.container {
  justify-content: center;
}
.item {
  align-self: center;
}

// set the flex item's margin value to auto:
.item {
  margin: auto;
}
```

## IV.   Examples
### Building a Navigation Bar with Flexbox
  - It's possible for an element to be both a flex item and a flex container.

```
// giving .main-header a justify-content: space-between; declaration positions the site name on the left side of the header and the navigation menu on the right:
.main-header {
  justify-content: space-between; 
}

// here is a mobile first approach where the navigation bar changes based on browser-width
@media (min-width: 769px) {
  .main-header, .main-nav {
    display: flex;
  }
  .main-header {
    flex-direction: column;
    align-items: center;
  }
}
@media (min-width: 1025px) {
  .main-header {
    flex-direction: row;
    justify-content: space-between;
  }
}
```

### Creating a Two Column Layout with Flexbox
  - With flexbox, it's simple to create flexible multi-column layouts without using floats or inline-block display.
  - You can assign an equal amount of space to columns with the flex-grow and flex properties.

```
// here all .col in .row would be equally sized
.row {
  display: flex;
}
.col {
  flex: 1;
}

// here the .col .primary will be twice the size of the other .col
.row {
  display: flex;
}
.col {
  flex: 1;
}
.primary {
  flex: 2;
}
```

### Creating a Three Column Layout with Flexbox
  - You can use flexbox to make responsive column calculations less complex.
  - Use the flex-basis property to set the initial size you want the column items to be.

```
// here on smaller screens the 3 colums will stack, with 2 of them taking up 50% and the 3rd taking up 100% of a row
// on larger screens all 3 are equal width
@media (min-width: 769px) {
  .main-header,
  .main-nav,
  .row {
    display: flex;
  }
  .main-header {
    flex-direction: column;
    align-items: center;
  }
  .col {
    flex: 1 50%;
  }
  .row {
    flex-wrap: wrap;
  }
}

@media (min-width: 1025px) {
  .main-header {
    flex-direction: row;
    justify-content: space-between;
  }
  .col {
    flex-basis: 0;
  }
}

// here the primary column will be slightly larger than the other two columns on larger screens
// it will also appear in the middle column on larger screens, while remaining the first column on smaller ones
@media (min-width: 769px) {
  .main-header,
  .main-nav,
  .row {
    display: flex;
  }
  .main-header {
    flex-direction: column;
    align-items: center;
  }
  .col {
    flex: 1 50%;
  }
  .row {
    flex-wrap: wrap;
  }
  .secondary {
    order: -1;
  }
}

@media (min-width: 1025px) {
  .main-header {
    flex-direction: row;
    justify-content: space-between;
  }
  .col {
    flex-basis: 0;
  }
  .primary {
    flex-grow: 1.4;
  }
}
```

### Aligning Items to the Bottom of a Column
  - It's possible for an element to be both a flex item and a flex container.
  - A margin value of auto has an effect on flex item alignment because it absorbs any extra space around a flex item and pushes other flex items into different positions.

```
// here the .button will line-up with the bottom of the .col no matter how much content is above it
@media (min-width: 769px) {
  .main-header,
  .main-nav,
  .row,
  .col {
    display: flex;
  }
  .main-header {
    flex-direction: column;
    align-items: center;
  }
  .col {
    flex: 1;
    flex-direction: column;
  }
  .button {
    margin-top: auto;
  }
}
```

### Creating a Sticky Footer with Flexbox
[min-height - MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/min-height)  
[Sizing with vh Units](http://snook.ca/archives/html_and_css/vm-vh-units)  

  - When you make body a flex container, it lays out all its direct children horizontally on a single line.
  - Setting the flex-direction of body to column stacks its flex items vertically.
  - 1vh is equal to 1/100th or 1% of the viewport height.
  
```
// this is a simple sticky footer
body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.row {
  flex: 1;
}

// the html
<body>
  <header class="main-header"></header>
  <div class="row"></div>
  <footer class="main-footer"></footer>
</body>
```
