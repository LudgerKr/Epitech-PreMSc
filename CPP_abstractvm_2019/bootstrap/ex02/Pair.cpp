#include "Pair.hpp"

template <>
Pair<int>::Pair(const int  &x, const int &y)
: _x(x), _y(y)
{

}

template <>
Pair<int>::~Pair()
{

}

template <>
int Pair<int>::min() const
{
    return ((this->_x < this->_y) ? (this->_x) : (this->_y));
}

template <>
Pair<float>::Pair(const float  &x, const float &y)
: _x(x), _y(y)
{

}

template <>
Pair<float>::~Pair()
{

}

template <>
float Pair<float>::min() const
{
    return ((this->_x < this->_y) ? (this->_x) : (this->_y));
}

template <>
Pair<std::string>::Pair(const std::string  &x, const std::string &y)
: _x(x), _y(y)
{

}

template <>
Pair<std::string>::~Pair()
{

}

template <>
std::string Pair<std::string>::min() const
{
    return ((this->_x < this->_y) ? (this->_x) : (this->_y));
}

// template <typename T>
// T Pair::max()
// {
//     return ((this->_a > this->_b) ? (this->_b) : (this->_a));
// }

// Try catch in constructor
// CommunicationDevice::CommunicationDevice(std::istream &input,
//                                          std::ostream &output)
// try : _api(input, output)
// {
// } catch (std::exception &e) {
//     throw (CommunicationError(std::string("Error: ") + e.what()));
// }

// Explicit and delete * + operator= ptr ptr
        // explicit SimplePtr(BaseComponent *rawPtr);
        // ~SimplePtr();
        // BaseComponent *get() const;
// if _rawPtr*
// SimplePtr::~SimplePtr()
// {
//     if (_rawPtr)
//         delete _rawPtr;
// }

// SimplePtr &SimplePtr::operator=(SimplePtr const &rhs)
// {
//     if (_rawPtr)
//         delete _rawPtr;
//     _rawPtr = rhs.get();
//     return (*this);
// }

// ref and const
// public:
//     Fruit(const std::string &name, const int &vitamins);
//     virtual ~Fruit(){}

//     int getVitamins() const { return (_vitamins); }
//     std::string getName() const { return (_name); }
// private:
//     std::string _name;
//     int _vitamins;

// template funct
// template <typename T>
// T min(T x, T y) {
//     if (x > y)
//         return (y);
//     return (x);
// }

// Different kind of template
// template<typename T>
// bool equal(const T &x, const T &y);

// template<typename T>
// class Tester
// {
// public:
//     bool equal(const T &x, const T &y);
// };

// template<>
// bool equal(const std::string &x, const std::string &y) {
//     return (x == y);
// }

// template<>
// bool Tester<int>::equal(const int &x, const int &y) {
//     return (x == y);
// }