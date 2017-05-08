using System;

namespace Abstract_Classes_and_Methods
{

    // to declare an abstract class, add the `abstract` keyword before 
    // the keyword class
    abstract class MyClass
    {
        // to declare and abstract method, add the `abstract` keyword before the retun type
        public abstract void MyAbstractMethod();
    }


    class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Hello World!");
        }
    }

}
