#include "List.hpp"
#include "Vector.hpp"
#include "Map.hpp"
#include "Stack.hpp"

int main(int ac, char *av[])
{
    std::cout << "\n\nUse of List" << std::endl;
    List *l = new List();
    l->addElementList(10);
    l->addElementList(11);
    l->addElementList(12);
    std::list<int> tmplist = l->getList();

    for (auto const& i: tmplist) { // or for  std::for_each // put this in class
        std::cout << i << " " << std::endl;
    }
    for (auto it = tmplist.cbegin(); it != tmplist.cend(); it++) { // iterator
        std::cout << *it << std::endl;
    }
    delete(l);

    std::cout << "\n\nUse of Stack" << std::endl;

    Stack *s = new Stack();
    s->addElementStack(30);
    s->addElementStack(31);
    s->addElementStack(32);
    std::stack<int> tmpStack = s->getStack();

    Stack *news = new Stack();
    while (!s->getStack().empty()) { // put this in class + create list back + swap reverse list
        // news = s;
        std::cout << s->getStack().top() << std::endl;
        s->deleteElementStack();
    }

    // Operator =  need to finish
    // while (!news->getStack().empty()) {
    //     std::cout << news->getStack().top() << std::endl;
    //     news->deleteElementStack();
    // }
    delete(news);
    delete(s);

    std::cout << "\n\nUse of Vector" << std::endl;

    Vector *v = new Vector();
    v->addElementVector(40);
    v->addElementVector(41);
    v->addElementVector(42);
    std::vector<int> tmpVector = v->getVector();

    for (auto it = tmpVector.cbegin(); it != tmpVector.cend(); it++) { // put this in class
        std::cout << *it << std::endl;
    } 
    for (auto const& i: tmpVector) { // or for  std::for_each // put this in class
        std::cout << i << " " << std::endl;
    }
    delete(v);

    std::cout << "\n\nUse of Map" << std::endl;

    Map *m = new Map();
    m->addElementMap(1, 50);
    m->addElementMap(2, 51);
    m->addElementMap(3, 52);
    std::map<int, int> tmpMap = m->getMap();

    for (auto it = tmpMap.cbegin(); it != tmpMap.cend(); it++) { // put this in class
        std::cout << it->first << std::endl;
    } 
    // for (auto const& i: tmpMap) { // or for  std::for_each // put this in class
    //     std::cout << i << " " << std::endl;
    // }
    delete(m);

    return (0);
}