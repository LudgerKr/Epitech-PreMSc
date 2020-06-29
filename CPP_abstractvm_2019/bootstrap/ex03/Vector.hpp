#ifndef VECTOR_HPP
#define VECTOR_HPP

#include <vector>

class Vector {
public:
    Vector();
    ~Vector();
    std::vector<int> getVector() const { return (_v); }
    void addElementVector(int value) {
        this->_v.push_back(value);
    }
    void deleteElementVector() {
        this->_v.pop_back();
    }
private:
    std::vector<int> _v;
};

#endif /* VECTOR_HPP */