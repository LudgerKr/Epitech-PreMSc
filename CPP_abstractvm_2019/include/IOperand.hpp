#ifndef IOPERAND_HPP_
#define IOPERAND_HPP_

#include <iostream>

/* DIFFERENTS TYPES */
enum eOperandType {
    INT8 = 0,
    INT16 = 1,
    INT32 = 2,
    FLOAT = 3,
    DOUBLE = 4,
    BIGDECIMAL = 5,
};

/* PRECISION OF TYPE */
enum ePrecision {
    ONE = -2,
    TWO = -1,
    THREE = 0,
    FOUR = 1,
    FIVE = 2,
    SIX = 3,
};

class IOperand
{
public:
    virtual ~IOperand() {}

    virtual std::string toString() const = 0;
    virtual eOperandType getType() const = 0;
    virtual ePrecision getPrecision() const = 0;

    /* OPERATOR THAT NEED TO BE OVERLOAD */
    virtual const IOperand *operator+(const IOperand& rhs) const = 0;
    virtual const IOperand *operator-(const IOperand& rhs) const = 0;
    virtual const IOperand *operator*(const IOperand& rhs) const = 0;
    virtual const IOperand *operator/(const IOperand& rhs) const = 0;
    virtual const IOperand *operator%(const IOperand& rhs) const = 0;
};

#endif /* IOPERAND_HPP_ */