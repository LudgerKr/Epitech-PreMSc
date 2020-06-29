#ifndef AANIMAL_HPP_
#define AANIMAL_HPP_

#include <iostream>
#include <exception>
#include <type_traits>
#include <typeinfo>
#include <string>
#include "MyException.hpp"


class AAnimal : public std::exception {
public:
    AAnimal(std::string name, const std::string className);
    ~AAnimal();

    std::string getName() const { return (this->_name); }
    bool getIsSavage() const { return (this->_isSavage); }
    const std::string getClassName() const { return this->_className; }
    std::string getName() { return this->_name; }
    void setIsSavage(bool isSavage) { this->_isSavage = isSavage; }
    void setName(std::string name) { this->_name = name; }

    void jump() const;
    void run();
    void run(int distance);
    virtual void crock() const;
    virtual void eatAnimal(AAnimal *animal) const;
    virtual void talk() const = 0;

protected:
    bool isSavage();

private:
    std::string _name;
    const std::string _className;
    bool _isSavage;
};

#endif /* AANIMAL_HPP_ */