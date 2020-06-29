#ifndef CAT_HPP_
#define CAT_HPP_

#include <iostream>
#include "AAnimal.hpp"
#include "Mouse.hpp"

class Cat : public AAnimal {
public:
    Cat(const std::string& name);
    Cat();
    ~Cat();
    void talk() const
    {
        std::cout << "meww" << std::endl;
    }
private:
    const std::string _name;
};

#endif /* CAT_HPP_ */