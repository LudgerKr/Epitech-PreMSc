### Abstract VM

# Goal
The goal of this project is to create a simple virtual machine that is able to interpret programs that are written
in a simplified assembler language. To be precise, it consists in a stack machine that is able to calculate
simple arithmetical expressions. These very arithmetical expressions are given to the machine in the form
of simple assembler programs

# Explication of the project and Class, Interface

1. Lexer (Class)

This is made to analyse the input from the *.avm.
Then to convert the input into a sequence of token and value to have a easier way to parse it.
Into the lexer, we will do a error handling about the input file or input stream and arguments.

2. Parser (Class)

We will Parse the output from the Lexer to a different way so we can interprate it from our program to calculate the arithmetical expressions easier.
The error handling is made about the Syntactical errors, Unknown instruction.

3. Factory (Class)

The class Factory is the main part for the creation of each Operand with the particular type as index to track through lifetime each type of Operand.

4. Instruction (Class)

Therefor, we will initialize every different instruction Read & Print & Clear & Exit or for the stack that the program will be able to use :
- push VALUE
- pop
- dump
- clear
- dup
- swap
- assert VALUE
- load VALUE
- store VALUE
- print
- exit

5. IOperand (Interface)

The Interface for the different operator of calculation for the calculator of the arithmetical expressions.
Inside we have the enum 'eOperandType' for the different type of Operand
It will be user by the Operand class, to have a easier way to convert type and use them for calculation


6. Operand (Class)

This is where we are going to implement the interface IOperand.
So that we can calculate with arithmetical instruction all the different type of Operand (Int8, Int16, Int32, Float, Double, BidDecimal)

7. AbstractVmException (class)

Made for having a proper manner to throw exception and having the program to end properly

