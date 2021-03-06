<?php

namespace BitWasp\Bitcoin\Transaction;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Buffertools\Parser;
use BitWasp\Bitcoin\Serializer\Transaction\TransactionSerializer;

class TransactionFactory
{
    /**
     * @return TransactionSerializer
     */
    public static function getSerializer()
    {
        $serializer = new TransactionSerializer;
        return $serializer;
    }

    /**
     * @return Transaction
     */
    public static function create()
    {
        $transaction = new Transaction;
        return $transaction;
    }

    /**
     * @param TransactionInterface $tx
     * @return TransactionBuilder
     */
    public static function builder(TransactionInterface $tx = null)
    {
        $tx = $tx ?: self::create();
        $builder = new TransactionBuilder(Bitcoin::getEcAdapter(), $tx);
        return $builder;
    }

    /**
     * @param $string
     * @return Transaction
     */
    public static function fromHex($string)
    {
        $serializer = self::getSerializer();
        $hex = $serializer->parse($string);
        return $hex;
    }

    /**
     * @param Parser $parser
     * @return Transaction
     */
    public static function fromParser(Parser & $parser)
    {
        $serializer = self::getSerializer();
        $hex = $serializer->fromParser($parser);
        return $hex;
    }
}
