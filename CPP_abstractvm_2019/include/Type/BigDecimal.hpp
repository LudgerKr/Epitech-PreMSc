#ifndef BIGDECIMAL_HPP_
#define BIGDECIMAL_HPP_

#include "../Operand.hpp"

class BigDecimal : public Operand<int64_t> {
public:
    BigDecimal(const std::string& value);
    ~BigDecimal();
private:
};

#endif /* BIGDECIMAL_HPP_ */