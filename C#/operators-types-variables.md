# Operators, Variables, and Types in C#


### Variables and Types
 - C3 is a `Strongly Typed` language. Thus all operations on variables are performed with consideration of what the variable's `Type` is.
 - Types
 ⋅⋅* Boolean
 ⋅⋅* Integrals
 ⋅⋅* Floating Point
 ⋅⋅* Decimal
 ⋅⋅* String


### The Boolean Type
Declared using the keyword, `bool`.  

 The only values that satisfy a `bool` condition are `true` and `false` (which are official keywords).

```
using System;

class Booleans
{
  public static void Main()
  {
    bool content = true;
    bool noContent = false;

    Console.WriteLine("It is {0} that C# Station provides C# programming language content.", content);
    Console.WriteLine("The statement above is not {0}.", noContent);
  }
}
```


### Integral Types
An `integral` is a category of types. They are whole numbers, either signed or unsigned, and the char type. The char type is a Unicode character, as defined by the Unicode Standard. Visit [The Unicode Home Page](http://www.unicode.org/) for more info.

| Type     | Size (in bits) | Range                                         |
| -------- |:--------------:| ---------------------------------------------:|
| sbyte    | 8              | -128 to 127                                   |
| byte     | 8              | 0 to 255                                      |
| short    | 16             | -32768 to 32767                               |
| ushort   | 16             | 0 to 65535                                    |
| int      | 32             | -2147483648 to 2147483647                     |
| uint     | 32             | 0 to 4294967295                               |
| long     | 64             | -9223372036854775808 to 9223372036854775807   |
| ulong    | 64             | 0 to 18446744073709551615                     |
| char     | 16             | 0 to 65535                                    |

