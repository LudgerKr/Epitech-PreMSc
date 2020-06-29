#ifndef INT32_HPP_
#define INT32_HPP_

#include "../Operand.hpp"

class Int32 : public Operand<int32_t> {
public:
    Int32(const std::string& value);
    ~Int32();
private:
};

#endif /* INT32_HPP_ */