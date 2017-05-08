using System;

namespace Inheritance
{

	class Member
	{
		// A protected field is only accessible with the class in which it is 
		// declared and any class that is derived from it.
		protected int annualFee;
		private string name;
		private int memberID;
		private int memberSince;

		// Overwrite the ToString() method
		public override string ToString()
		{
			return "\nName: " + name +
				"\nMember ID: " + memberID +
				"\nMember Since: " + memberSince +
				"\nTotal Annual Fee: " + annualFee;
		}

		// Constructors
		public Member()
		{
			Console.WriteLine("Parent Constructor with no parameter");
		}

		public Member(string pName, int pMemberID, int pMemberSince)
		{
			Console.WriteLine("Parent Constructor with 3 parameters");
			name = pName;
			memberID = pMemberID;
			memberSince = pMemberSince;
		}

        // the virtual keyword tells the compiler that this method may be overridden 
        // in derived (child) classes
        public virtual void CalculateAnnualFee()
        {
            annualFee = 0;
        }

	}


	// Here is our derived (child) class of the parent Member class
	class NormalMember : Member
	{

		// the child class's constructor
		// the constructor of a child is built upon the parent's constructor
		// the parent class constructor is always called first.

		// There are two ways to write a child contructor

		// the first is to just declare it like any other constructor.
		// C# looks for a parameterless constructor in the parent class 
		// and calls that first before executing the child contructor.
		public NormalMember()
		{
			Console.WriteLine("Child contructor with no parameter");

			// This would output these lines to the console:
			// Parent Constructor with no parameter
			// Child constructor with no parameter
		}

		// the second way to declare a child constructor is to use the colon 
		// sign and the base keyword to call a non parameterless constructor 
		// in the parent class.
		// this new child constructor has 4 parameters. the first parameter
		// (string remarks) is used inside of the child constructor. the other
		// three paramters are not used in the child constructor, instead they 
		// are passed as arguments to the parent constructor
		public NormalMember(string remarks, string name, int memberID,
							int memberSince) : base(name, memberID, memberSince)
		{
			Console.WriteLine("Child Constructor with 4 parameters");
			Console.WriteLine("Remarks = {0}", remarks);
		}

		// this method calculaes the annual fee of a normal member
		// the override keyword is used to delare that this method overrides the method in the
		// parent class
		public override void CalculateAnnualFee()
		{
			annualFee = 100 + 12 * 30;
		}

	}


	// Another child class of the Member class
	class VIPMember : Member
	{

		// child constructor
		public VIPMember(string name, int memberID, int memberSince) : base(name, memberID, memberSince)
		{
			Console.WriteLine("Child Constructor with 3 parameters");
		}

		// method that calculates the fee for a VIP member
        // the override keyword is used to delare that this method overrides the method in the
        // parent class
		public override void CalculateAnnualFee()
		{
			annualFee = 1200;
		}

	}

	class Program
	{
		static void Main(string[] args)
		{

            // we can use one array for NormalMember and VIPMember objects because both
            // are child classes of the Member class
            Member[] clubMembers = new Member[5];

            // adding members (from both child classes to our clubMembers array
            clubMembers[0] = new NormalMember("Special Rate", "James", 1, 2010);
            clubMembers[1] = new NormalMember("Normal Rate", "Andy", 2, 2011);
            clubMembers[2] = new NormalMember("Normal Rate", "Bill", 3, 2011);
            clubMembers[3] = new VIPMember("Carol", 4, 2012);
            clubMembers[4] = new VIPMember("Evelyn", 5, 2012);

            // calculate the annual fee of each member and display the info
            foreach (Member m in clubMembers)
            {
                m.CalculateAnnualFee();
                Console.WriteLine(m.ToString());
            }

		}
	}
}
