#ifndef VM_HPP_
#define VM_HPP_

#include "Error.hpp"
#include "Operand.hpp"
#include "ErrorMain.hpp"
#include "Factory.hpp"
#include "util.hpp"

class Vm {
public:
    Vm();
    const Vm& operator=(const Vm&);
    ~Vm();

    // Function to read file and exec program
    void useFileInput(char *filename); // Read the file input
    void execProgram(); // Exec the program from the file input

    // Function to read cin and exec instruction
    void useStandardInput(); // use and read the standard input
    void execInstruction(); // exec instruction form map  member function

    // Instruction for Clear / Read / Exit / Print
    void exit(instruction_t instruction); // Quit the program
    void clear(instruction_t instruction);  // Clear all the stack
    void dump(instruction_t instruction); // Print each value of the stack
    void print(instruction_t instruction); // Print value at the top

    // Instruction Arithmetic
    void add(instruction_t instruction);
    void sub(instruction_t instruction);
    void mul(instruction_t instruction);
    void div(instruction_t instruction);
    void mod(instruction_t instruction);

    // Instruction for Stack
    void swap(instruction_t instruction); // swap the two first value of the stack
    void dup(instruction_t instruction); // duplicate the value on the top of the stack
    void pop(instruction_t instruction); // delete first value of the stack
    void push(instruction_t instruction); // push value at the top of the stack
    void load(instruction_t instruction); // load value from reg to stack
    void store(instruction_t instruction); // store first value stack to reg
    void assert(instruction_t instruction); // Verify the top value of the stack

private:
    class VmError : public Error {
    public:
        VmError(const std::string& msg)
        : _msg(msg), Error() 
        {

        }
        virtual ~VmError() throw () {}

        virtual const char* what() const throw() {
            return (_msg.c_str());
        }
    private:
        const std::string _msg;
    };

    /* Vector for the input read */
    std::vector<instruction_t> _input;

    /* Stack for IOperand */
    std::stack<const IOperand *> _stack;

    /* Map for the register index 0-14 */
    std::map<int, const IOperand *> _reg;

    /* Function pointer for all instruction of the VM */
    std::map<std::string, void (Vm::*)(instruction_t instruction)> _instructions;
};

#endif /* VM_HPP_ */