#include "../../include/Type/BigDecimal.hpp"

BigDecimal::BigDecimal(const std::string& value) 
: Operand(value, BIGDECIMAL, SIX)
{

}

BigDecimal::~BigDecimal()
{

}