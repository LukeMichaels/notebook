// Namespace Declaration
using System;

// Program start class
class NamedWelcome
{
  // Main begins program execution.
  static void Main(string[] args)
  {
    // Write to console
    Console.WriteLine("Hello, {0}!", args[0]);
    Console.WriteLine("Welcome!"); 
  }
}

// if you compile this using `mcs namedWelcome.cs`
// then pass a name value, like this `mono namedWelcome.exe Luke`
// it will output
// "Hello, Luke!"
// "Welcome!"