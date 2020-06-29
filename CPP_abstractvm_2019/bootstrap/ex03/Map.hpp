#ifndef MAP_HPP
#define MAP_HPP

#include <map>
#include <algorithm>

class Map {
public:
    Map();
    ~Map();
    std::map<int, int> getMap() const { return (_m); }
    void addElementMap(int a, int b) {
        this->_m.insert({a, b});
    }
    void deleteElementMap(std::map<int,int>::iterator it) {
        this->_m.erase(it);
    }
private:
    std::map<int, int> _m;
};

#endif /* MAP_HPP */