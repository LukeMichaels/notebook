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


### Floating Point and Decimal Types
A floating point type is either a `float` or `double`.  

Floating point types are used when you need to perform operations requiring fractional representations. However, for financial calculations, the decimal type is the best choice because you can avoid rounding errors.  

| Type     | Size (in bits) | Precision            | Range                       |
| -------- |:--------------:| :-------------------:| ---------------------------:|
| float    | 32             | 7 digits             | 1.5 x 10-45 to 3.4 x 1038   |
| double   | 64             | 15-16 digits         | 5.0 x 10-324 to 1.7 x 10308 |
| decimal  | 128            | 28-29 decimal places | 1.0 x 10-28 to 7.9 x 1028   |


### The string Type
A string is a sequence of text characters.  

#### Character Escape Sequences
| Escape Sequence | Meaning                                 |
| --------------- | ---------------------------------------:|
| \’              | Single Quote                            |
| \”              | Double Quote                            |
| \\              | Backslash                               |
| \0              | Null, not the same as the C# null value |
| \a              | Bell                                    |
| \b              | Backspace                               |
| \f              | form Feed                               |
| \n              | Newline                                 |
| \r              | Carriage Return                         |
| \t              | Horizontal Tab                          |
| \v              | Vertical Tab                            |