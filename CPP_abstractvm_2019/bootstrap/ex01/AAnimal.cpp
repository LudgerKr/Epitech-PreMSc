#include "AAnimal.hpp"
#include "Lion.hpp"
#include "Cat.hpp"

AAnimal::AAnimal(std::string name, const std::string className)
: _name(name), _className(className)
{
    std::cout << name << " born" << std::endl;
}

AAnimal::~AAnimal()
{
    // std::cout << this->_name << " die" << std::endl;
}

void AAnimal::jump() const
{
    std::cout << this->_name << ": jump" << std::endl;
}

bool AAnimal::isSavage() 
{
    return (_isSavage ? true : false);
}

void AAnimal::run()
{
    std::cout << "ruuun!" << std::endl;
}

void AAnimal::run(int distance)
{
    std::cout << "running " << std::to_string(distance) << " kilometers." << std::endl;
}

void AAnimal::eatAnimal(AAnimal *animal) const
{

    if ((this->getClassName().compare("Mouse") == 0) 
    && ((animal->getClassName().compare("Cat") == 0) 
    || (animal->getClassName().compare("Lion") == 0))) {
        throw MyException("Error: Mouse cant eat lion or cat");
    } else {
        std::cout << animal->getName() << " ";
        this->crock();
    }

    // if (dynamic_cast<Lion*>(animal) != nullptr) {
        // throw MyException("Error: Wrong animal lion");
    // } else if (dynamic_cast<Cat*>(animal) != nullptr) {
    //     throw MyException("Error: Wrong animal cat");
    // } else {
    //     std::cout << animal->getName() << " ";
    //     this->crock();
    // }
}

void AAnimal::crock() const
{
    std::cout << "I'm dead" << std::endl;
}
