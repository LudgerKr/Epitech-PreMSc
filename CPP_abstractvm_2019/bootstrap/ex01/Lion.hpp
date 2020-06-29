#ifndef LION_HPP_
#define LION_HPP_

#include "AAnimal.hpp"
#include <iostream>

class Lion : public AAnimal {
public:
    Lion(const std::string& name);
    Lion();
    ~Lion();
    void talk() const
    {
        std::cout << "graouhhh" << std::endl;
    }
private:
};

#endif /* LION_HPP_ */