#include "AnimalFactory.hpp"

AnimalFactory::AnimalFactory()
{

}

AnimalFactory::~AnimalFactory()
{

}

Cat AnimalFactory::buy(const std::string& name)
{
    Cat cat(name);
    return (cat);
}