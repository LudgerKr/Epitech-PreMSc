#ifndef FLOAT_HPP_
#define FLOAT_HPP_

#include "../Operand.hpp"

class Float : public Operand<float> {
public:
    Float(const std::string& value);
    ~Float();
private:
};

#endif /* FLOAT_HPP_ */