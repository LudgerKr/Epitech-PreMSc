#ifndef MOUSE_HPP_
#define MOUSE_HPP_

#include <iostream>
#include "AAnimal.hpp"

class Mouse : public AAnimal {
public:
    Mouse();
    Mouse(const std::string& name);
    ~Mouse();

    void talk() const
    {
        std::cout << "crss" << std::endl;
    }
    void crock() const override;
private:
};

#endif /* MOUSE_HPP_ */