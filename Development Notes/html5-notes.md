#HTML5
A markup language used for structuring and presenting content on the World Wide Web. It was finalized, and published, on 28 October 2014 by the World Wide Web Consortium (W3C). This is the fifth revision of the HTML standard since the inception of the World Wide Web.  

### Doctype
```
<!DOCTYPE html>
<meta charset="UTF-8">
<script src="file.js"></script>
<link rel="stylesheet" href="file.css">
```
```
JavaScript to test for supported browser attributes
function elementSupportsAttribute(element,attribute) {
  var test = document.createElement(element);
  if (attribute in test) {
     return true;
  } else {
    return false;
  }
}

if (!elementSupportsAttribute('input','placeholder')) {
  // JavaScript fallback goes here.  
}
```

### Text Tags
```
<small> <!— used for small print, legalese or terms and conditions —>
<b> <!— no longer bold, text is stylistically offset from the normal prose without conveying any extra importance —>
<strong> <!—used on text with extra importance, sort-of replaces the <b> tag —>
<i> <!— no longer italic, an alternate voice or mood —>
<em> <!— emphasis —>
<cite> <!— the title of a work —>
```

### Audio
```
<audio src="witchitalineman.mp3"></audio>  <!— embed an audio file —>
Boolean attributes: <!— boolean attributes don’t require a value, they’re either present or they aren’t —>
controls - will add play, pause and value controls.
loop - loops the audio file.
auto play - automatically plays the audio file.


preload - load up audio file, but don’t automatically play it.
preload=“none” <!— can be none, auto, or metadata —>

<!— unfortunately, not all browsers support the same audio file types. To make up for that you can declare various sources. —>
<audio controls>
  <source src="witchitalineman.ogg" type="audio/ogg">
  <source src="witchitalineman.mp3" type="audio/mpeg">
</audio>

<!— furthermore, IE doesn’t support the audio tag, so flash needs to be included —>
<audio controls>
  <source src="witchitalineman.ogg" type="audio/ogg">
  <source src="witchitalineman.mp3" type="audio/mpeg">
  <object type="application/x-shockwave-flash" 
  data="player.swf?soundFile=witchitalineman.mp3">
    <param name="movie" 
    value="player.swf?soundFile=witchitalineman.mp3">
    <a href="witchitalineman.mp3">Download the song</a>
  </object>
</audio>
```

### Video
```
<video src="movie.mp4" controls width="360" height="240" poster="placeholder.jpg"></video>

<!— competing video formats are even worse than audio formats… —>
<video controls width="360" height="240" poster="placeholder.jpg">
  <source src="movie.ogv" type="video/ogg">
  <source src="movie.mp4" type="video/mp4">
  <object type="application/x-shockwave-flash" 
  width="360" height="240" 
  data="player.swf?file=movie.mp4">
    <param name="movie" 
    value="player.swf?file=movie.mp4">
    <a href="movie.mp4">Download the movie</a>
  </object>
</video>
```

### Forms
```
<!— the placeholder attribute fills a field with placeholder text —>
<label for="hobbies">Your hobbies</label>
<input id="hobbies" name="hobbies" type="text" placeholder="Owl stretching">

Autofocus - When the document loads, automatically focus one particular form field.
<label for="status">What's happening?</label>
<input id="status" name="status" type="text" autofocus>

Required - Denotes a required field, replaces JS form validation 
<label for="pass">Your password</label>
<input id="pass" name="pass" type="password" required>

Autocomplete - Browsers assume that this is on by default, set sensitive info to off
<form action="/selfdestruct" autocomplete="off">

Datalist - Allows crossbreeding of a regular input element with a select element. This way users can select and option from a list, or type in their own (great for “other” fields).
<label for="homeworld">Your home planet</label>
<input type="text" name="homeworld" id="homeworld"  
list="planets">
<datalist id="planets">
  <option value="Mercury">
  <option value="Venus">
  <option value="Earth">
  <option value="Mars">
  <option value="Jupiter">
  <option value="Saturn">
  <option value="Uranus">
  <option value="Neptune">
</datalist>
```

### Input Types
```
<!-- Searching -->
<label for="query">Search</label>
<input id="query" name="query" type="search">
```
