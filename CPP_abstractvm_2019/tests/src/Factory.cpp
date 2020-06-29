#include "../include/Factory.hpp"

Factory::Factory()
{
    this->_createType[INT8] = &Factory::createInt8;
    this->_createType[INT16] = &Factory::createInt16;
    this->_createType[INT32] = &Factory::createInt32;
    this->_createType[FLOAT] = &Factory::createFloat;
    this->_createType[DOUBLE] = &Factory::createDouble;
    this->_createType[BIGDECIMAL] = &Factory::createBigDecimal;
}

Factory::~Factory()
{

}

const IOperand *Factory::createOperand(eOperandType type, const std::string& value) const
{
    const IOperand *(Factory::*create)(const std::string& value) const;
    create = _createType.at(type);
    return ((*this.*create)(value));
}

const IOperand *Factory::createInt8(const std::string& value) const
{
    return (new Int8(value));
}

const IOperand *Factory::createInt16(const std::string& value) const
{
    return (new Int16(value));
}

const IOperand *Factory::createInt32(const std::string& value) const
{
    return (new Int32(value));
}

const IOperand *Factory::createFloat(const std::string& value) const
{
    return (new Float(value));
}

const IOperand *Factory::createDouble(const std::string& value) const
{
    return (new Double(value));
}

const IOperand *Factory::createBigDecimal(const std::string& value) const
{
    return (new BigDecimal(value));
}
