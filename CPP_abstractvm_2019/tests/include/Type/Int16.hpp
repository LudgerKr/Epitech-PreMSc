#ifndef INT16_HPP_
#define INT16_HPP_

#include "../Operand.hpp"

class Int16 : public Operand<int16_t> {
public:
    Int16(const std::string& value);
    ~Int16();
private:
};

#endif /* INT16_HPP_ */