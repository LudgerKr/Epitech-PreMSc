#ifndef ANIMALFACTORY_HPP_
#define ANIMALFACTORY_HPP_

#include "Cat.hpp"
#include <iostream>

class AnimalFactory {
public:
    AnimalFactory();
    ~AnimalFactory();

    Cat buy(const std::string& name);
private:
};

#endif /* ANIMALFACTORY_HPP_ */