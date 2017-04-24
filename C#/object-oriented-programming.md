# Object-Oriented Programming
An approach to programming that breaks a programming problem into objects taht interact with each other.


### Writing a Class
Start with the `class` keyword, followed by the name of a class.  

```
class Staff
{
  // contents of the class
  // including fields, properties and methods

}
```


### Class Fields
A field is a variable that is declared inside a class. Like other variables, they are used to store data.  

```
class Staff
{
  private string nameOfStaff;
  private const int hourlyRate = 30;
  private int hWorked;
}
```

`const` is a keyword that indicates the value cant be changed after it's created.  


### Access Modifiers
Access modifiers are like gate keepers, they control who has access to that field.  

A field can be `private, public, protected, or internal`.  

 - Private: can only be accessed from within the class itself. This is known as encapsulation. Encapsulation enables an object to hide data and behavior from other classes that do not need to know about them. It makes it easier to change code in the future if necessary, as it wont affect other classes. The second reason to use `private` is to prevent other classes to freely modify our fields, corrupting them.  

 - Public: can be accessed by other classes.  


### Properties
A `property` is commonly used to provide access to a private field in cases where the field is needed by other classes.  

A `property` contains two special methods known as accessors. The first is a getter, the second a setter.  

The getter returns the value of the field.  

```
get
{
  return hWorked;
}
```

The setter sets the value of the field.  

```
set
{
  if (value > 0)
    hWorked = value;
  else
    hWorked = 0;
}
```

`value` is a keyword when used inside a setter. It refers to the value that is on the right side of the assignment statement.  


### Methods
A `method` is a block of code that performs a certain task.  

```
// basic example of a method (no return value)
public void PrintMessage()
{
  Console.WriteLine("Calculating Pay...");
}

// a more advanced example (returns values)
public int CalculatePay()
{
  PrintMessage();

  int staffPay;
  staffPay = hWorked * hourlyRate;

  if (hWorked > 0)
    return staffPay;
  else
    return 0;
}
```


### Overloading
You can create to methods of the same name as long as they have different signatures. This is known as `overloading`. The signature of a method refers to the name of the method and the parameters that it has.  

```
// The signature of our first method is CalculatePay() while the method below is CalculatePay(int bonus, int allowance)
public int CalculatePay(int bonus, int allowance)
{
  PrintMessage());
  if (hWorked > 0)
    return hWorked * hourlyRateRate + bonus + allowance;
  else
    return 0;
}
```


### The ToString() method
The `ToString()` method is a special method that returns a string that represents the current class. All C# classes come with a  pre-defined `ToString()` method; However, it is customary to override this method.  

```
// The override keyworkd in the method declaration indicates that this method overrides the default method (who would've thought)
public override string ToString()
{
  return "Name of Staff = " + nameOfStaff + "  , hourlyRate = " + hourlyRate + ", hWorked = " + hWorked;
}
```


### Constructors
A `constructor` is a special method that is used to construct an object from the class template. It is the first method that is called whenever we create an object from our class. They are commonly used to initialize the fields of the class.  

```
public Staff(string name)
{
  nameOfStaff = name;
  Console.WriteLine("\n" + nameOfStaff);
  Console.WriteLine("--------------------------");
}
```

Like other methods, there can be more than on constructor as long as the signature is different (overloading FTW).  

```
public Staff(string firstName, string lastName)
{
  nameOfStaff = firstName + " " + lastName;
  Console.WriteLine("\n" + nameOfStaff);
  Console.WriteLine("--------------------------");
}
```

Declaring a constructor is optional. If one isn't declared C# will create one automatically. The default constructor simply initializes all of the fields in a class to default values (normally zero for numerical fields and an empty string for string fields).  


### Instantiating an Object
Is using a class to create an object.  

```
// The synatx for instantiating an object
ClassName objectName = new ClassName(arguments);

// Here we use the first constructor (the one with one parameter) to create our staff1 object.
Staff staff1 = new Staff("Peter");

// Once we create the object, we can use the dot operator after the object's name to access any 
// public field, property or method in the Staff class.

// Here we use the public EmployeeType property to assign a value to the hWorked field
// If we try to acces the private field hWorked directly we will get an error
staff1.HoursWorked = 160;

// Here we call the CalculatePay() method and assign the return value to a variable, pay
pay = staff1.CalculatePay(1000, 400)
```


### static Keyword
There are some classes or class members that can be accessed without the need to create any objects. These are known as `static classes` and are declared using the `static` keyword.  


```
class MyClass
{
  // Non static members
  public string message = "Hello World";
  public string Name { get; set; }
  public void DisplayName()
  {
    Console.WriteLine("Name = {0}", Name};
  }

  // Static members
  public static string greetings = "Good morning";
  public static int Age { get; set; }
  public static void DisplayAge()
  {
    Console.WriteLine("Age = {0}", Age);
  }
}
```

To access the `non static` members of MyClass from another class, we need to instantiate an object as before:  

```
MyClass classA = new MyClass();

Console.WriteLine(classA.message);
classA.Name = "Jamie";
classA.DisplayName();
```

To access `static` members, we do not need to create an object. We can use the class name to access them:  

```
Console.WriteLine(MyClass.greetings);
MyClass.Age = 39;
MyClass.DisplayAge();
```

In addition to static methods, fields, properties and constructors, static classes can also be created. A static class can only contain static members:  

```
static class MyStaticClass
{
  public static int a = 0;
  public static int B{get; set;}
}
```

Some pre-written C# classes are static. The `Console` class is static, we don not need to create a `Console` object when using methods from the `Console` class. We write:  

```
Console.WriteLine("Hello World");
```


### Advanced Method Concepts











