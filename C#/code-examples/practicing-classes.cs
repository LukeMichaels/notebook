using System;

namespace LearningClasses
{
  class Bicycle
  {
    private string typeOfBicycle;
    private string brandOfBicycle;

    public void PrintMessage()
    {
      Console.WriteLine("Registering Bicycle...");
    }

    public override string ToString()
    {
      return "Bicycle information: " + brandOfBicycle + " " + typeOfBicycle;
    }

    public Bicycle(string type, string brand)
    {
      typeOfBicycle = type;
      brandOfBicycle = brand;
      Console.WriteLine("\n Brand: " + brand);
      Console.WriteLine("\n Type: " + type);
      Console.WriteLine("--------------------------");
    }

  }

  class Program
  {
    static void Main(string[] args)
    {
      Console.WriteLine("Bicycle Registration Index:");

      Bicycle bike1 = new Bicycle("6 Speed", "Nishiki");
      Bicycle bike2 = new Bicycle("12 Speed", "MASI");

    }
  }

}