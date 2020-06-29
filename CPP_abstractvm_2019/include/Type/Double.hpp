#ifndef DOUBLE_HPP_
#define DOUBLE_HPP_

#include "../Operand.hpp"

class Double : public Operand<double> {
public:
    Double(const std::string& value);
    ~Double();
private:
};

#endif /* DOUBLE_HPP_ */