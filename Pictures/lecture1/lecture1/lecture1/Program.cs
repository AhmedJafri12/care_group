// See https://aka.ms/new-console-template for more information
//Console.WriteLine("Hello, World!");


Console.WriteLine("Enter your name:");

string name = Console.ReadLine();

Console.WriteLine("Enter your phone number:");

string phone = Console.ReadLine();

Console.WriteLine("Enter your age:");

int age = Convert.ToInt32(Console.ReadLine());

Console.WriteLine("Enter your email:");

string email = Console.ReadLine();

Console.WriteLine($"\nUser details:\nName: {name}\nAge: {age}\nPhone: {phone}\nEmail: {email}");
