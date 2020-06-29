#include <iostream>
#include "Cat.hpp"
#include "Mouse.hpp"
#include "Lion.hpp"
#include "AnimalFactory.hpp"
#include "AAnimal.hpp"
#include "MyException.hpp"

int main(int ac, char *av[])
{
    Cat *cat = new Cat("Catou");
    Lion *lion = new Lion("Lion");
    Mouse *mouse = new Mouse("Mouse");
    AnimalFactory *factory = new AnimalFactory;

    std::cout << "Program begin\n" << std::endl;

    cat->jump();
    lion->jump();

    AAnimal *a = new Cat("animal chat");
    AAnimal *b = new Lion("animal lion");
    AAnimal *c = new Mouse("animal mouse");
    
    a->setIsSavage(true);
    std::cout << a->getName() << " " << (a->getIsSavage() ? "true" :  "false") << std::endl;
    

    a->talk();
    b->talk();
    c->talk();

    a->run();
    a->run(10);

    try {
        b->eatAnimal(cat);
    } catch (MyException& e) {
        std::cout << e.what() << std::endl; 
    } 
    try {
        c->eatAnimal(b);
    } catch (MyException& e) {
        std::cout << e.what() << std::endl; 
    }

    return (0);
}