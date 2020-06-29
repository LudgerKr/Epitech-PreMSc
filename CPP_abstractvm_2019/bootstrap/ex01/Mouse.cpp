#include "Mouse.hpp"

Mouse::Mouse(const std::string& name)
: AAnimal(name, "Mouse")
{

}

Mouse::Mouse()
: AAnimal("Souris", "Mouse")
{

}

Mouse::~Mouse()
{

}

void Mouse::crock() const
{
    std::cout << "I don't eat animals" << std::endl;
}
