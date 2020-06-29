#ifndef LIST_HPP
#define LIST_HPP

#include <list>
#include <algorithm>
#include <iostream>

class List {
public:
    List();
    ~List();

    std::list<int> getList() const { return (_l); }
    void addElementList(int value) {
        this->_l.push_front(value);
    }
    void deleteElementList() {
        this->_l.pop_front();
    }
private:
    std::list<int> _l;
};

#endif /* LIST_HPP */