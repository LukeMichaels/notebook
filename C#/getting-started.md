# Operators, Variables, and Types in C#

### Variables and Types
On Mac there are a few options:  
[MonoDevelop](http://www.monodevelop.com/download/)  
[Visual Studio Code](https://code.visualstudio.com/Download)  
[Visual Studio Mac](https://www.visualstudio.com/vs/visual-studio-mac/)   


### .Net Core SDK
We will need .Net Core  
[.Net Core for Mac](https://www.microsoft.com/net/core#macos)   

We also need to install a dependency, Openssl  
```
brew update
brew install openssl
mkdir -p /usr/local/lib
ln -s /usr/local/opt/openssl/lib/libcrypto.1.0.0.dylib /usr/local/lib/
ln -s /usr/local/opt/openssl/lib/libssl.1.0.0.dylib /usr/local/lib/
```


### Hello World
```
// Namespace Declaration
using System;

// Program start class
class WelcomeCSS
{
  // Main begins program execution.
  static void Main()
  {
    // Write to console
    Console.WriteLine("Hello World"); 
  }
}
```


### Using Mono on MacOS X
[Mono OS X Documentation](http://www.mono-project.com/docs/about-mono/supported-platforms/osx/)   

  - in terminal use `mcs` to run mono

```
mcs hello.cs
mono hello.exe
```

### Important things to note about C#

 -  C# is case-sensitive. The word `Main` is not the same as its lower case spelling, `main`.
 