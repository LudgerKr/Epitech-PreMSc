#include "include/Vm.hpp"

int main(int ac, char **av)
{
    try {
        std::unique_ptr<Vm> vm = std::make_unique<Vm>();
        if (ac > 2) {
            throw ErrorMain("Error: Too many arguments");
        } else if (ac == 2) {
            vm->useFileInput(av[1]);
            vm->execProgram();
        } else {
            vm->useStandardInput();
            vm->execProgram();
        }
    } catch (Error& e) {
        std::cout << e.what() << std::endl;
        return (84);
    }
    return (0);
}