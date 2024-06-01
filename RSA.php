<?php
//generating random 32 byte Base64 encoded AES key
$keyLength = 32;
$aesKey = openssl_random_pseudo_bytes($keyLength);
if ($aesKey === false) {
    die("Failed to generate a secure AES key.");
}

$key = $aesKey;

//Encrypting Session
$sessionKey = encryptSessionKey($key);
echo "Encrypted Session Key: " . $sessionKey . PHP_EOL;

/**
 * This PHP script is used to create encrypted session key using RSA alogorithm
 */
function encryptSessionKey($sessionkey)
{
    try {

        // As per coding standards and best practices it is not best practice to hard public certificate like below. This is done below just for reference purpose 
        //Define these values externally in file and refer it.
        $publicKey = "-----BEGIN CERTIFICATE-----
MIIG2zCCBcOgAwIBAgIQCII9lGZUKnQkO2GZxmOTeTANBgkqhkiG9w0BAQsFADBg
MQswCQYDVQQGEwXXXXXXXXXXXXXeKaEws6z2t5vVqtKG5gzxoE3KJwD6kQPX+
PM63X+yjg9fcpUvyEyB4kH4pOfRsvhja1v76Jk9/sg==
-----END CERTIFICATE-----";

        // Encrypt the data using the public key
        openssl_public_encrypt(
            $sessionkey,
            $encryptedData,
            $publicKey,
            OPENSSL_PKCS1_PADDING
        );

        return base64_encode($encryptedData);
    } catch (Exception $ex) {
        echo $ex->getMessage();
        return null;
    }
}

?>
