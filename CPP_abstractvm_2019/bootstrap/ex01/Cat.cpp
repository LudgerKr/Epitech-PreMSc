#include "Cat.hpp"

Cat::Cat(const std::string& name) 
: _name(name), AAnimal(name, "Cat")
{

}

Cat::Cat() 
: AAnimal("Chat", "Cat")
{

}

Cat::~Cat() 
{
}