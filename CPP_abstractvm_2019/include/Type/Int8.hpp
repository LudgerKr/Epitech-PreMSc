#ifndef INT8_HPP_
#define INT8_HPP_

#include "../Operand.hpp"

class Int8 : public Operand<char> {
public:
    Int8(const std::string& value);
    ~Int8();
private:
};

#endif /* INT8_HPP_ */