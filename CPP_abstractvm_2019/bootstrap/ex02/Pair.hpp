#ifndef PAIR_HPP_
#define PAIR_HPP_

#include <iostream>

template <typename T>
class Pair {
public:
    Pair(const T &x, const T &y);
    ~Pair();

    T min() const;
    T max() const;

    T _x;
    T _y;
};

#endif /* PAIR_HPP_ */