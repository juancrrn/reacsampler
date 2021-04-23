<?php

namespace Juancrrn\Reacsampler\Common;

class Tools
{
    
    /**
     * Formato estándar de tipo de dato DATETIME de MySQL.
     */
    public const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    
    /**
     * Formato estándar de tipo de dato DATE de MySQL.
     */
    public const MYSQL_DATE_FORMAT = 'Y-m-d';

    /**
     * Tipos de pruebas.
     */
    public const TEST_TYPE_PDIA_NAAT_RT_PCR = 'pdia_naat_rt_pcr';
    public const TEST_TYPE_PDIA_ANTIGEN     = 'pdia_antigen';
    public const TEST_TYPE_ABD_ELISA_CLIA   = 'abd_elisa_clia';
    public const TEST_TYPE_ABD_QUICK        = 'abd_quick';

    public const TEST_TYPES = array(
        self::TEST_TYPE_PDIA_NAAT_RT_PCR,
        self::TEST_TYPE_PDIA_ANTIGEN,
        self::TEST_TYPE_ABD_ELISA_CLIA,
        self::TEST_TYPE_ABD_QUICK
    );

    /**
     * Tipos de muestras para las pruebas.
     */
    public const TEST_SAMPLE_TYPE_SWAB_NASAL    = 'swab_nasal';
    public const TEST_SAMPLE_TYPE_SWAB_SALIVA   = 'swab_saliva';
    public const TEST_SAMPLE_TYPE_BLOOD_FINGER  = 'blood_finger';
    public const TEST_SAMPLE_TYPE_BLOOD_VEIN    = 'blood_vein';

    public const TEST_SAMPLE_TYPES = array(
        self::TEST_SAMPLE_TYPE_SWAB_NASAL,
        self::TEST_SAMPLE_TYPE_SWAB_SALIVA,
        self::TEST_SAMPLE_TYPE_BLOOD_FINGER,
        self::TEST_SAMPLE_TYPE_BLOOD_VEIN
    );
}

?>