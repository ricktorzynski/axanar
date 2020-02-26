<?php

namespace Ares\Utility;

use Ares\Database\Db;
use Ares\Exceptions\PasswordException\PasswordException;

class Password
{
    /**
     * @var int
     */
    protected const MIN_LENGTH = 8;
    /**
     * @var
     */
    protected $confirm;
    /**
     * @var
     */
    protected $recentHashes;
    /**
     * @var
     */
    protected $rejectAsTooObvious;

    public function __construct(array $rejectAsTooObvious = [])
    {
        $this->rejectAsTooObvious = $rejectAsTooObvious;
    }

    public function setConfirmation(string $confirm): void
    {
        $this->confirm = $confirm;
    }

    public function setPreviousPasswords(array $recentHashes = []): void
    {
        $this->recentHashes = $recentHashes;
    }

    /**
     * @param string $password
     *
     * @return bool
     * @throws \Ares\Exceptions\PasswordException\PasswordException
     */
    public function validate(string $password): bool
    {
        if (isset($this->confirm) && $this->confirm !== $password) {
            throw new PasswordException('New and confirmation passwords are different');
        }
        if (mb_strlen($password) < static::MIN_LENGTH) {
            throw new PasswordException(sprintf('New password must be at least %d characters long', static::MIN_LENGTH));
        }
        if ($this->isPasswordBlacklisted($password)) {
            throw new PasswordException('New password is too common, choose another');
        }
        if ($this->isPasswordObvious($password)) {
            throw new PasswordException('New password is too obvious, choose another');
        }
        if (isset($this->recentHashes) && $this->isRecentPassword($password)) {
            throw new PasswordException('New password has been used previously, choose another');
        }
        return true;
    }

    /**
     * @see : https://github.com/danielmiessler/SecLists/blob/master/Passwords/10_million_password_list_top_100000.txt
     * @note: All passwords with less than MIN_LENGTH characters have been removed from the file
     */
    protected function isPasswordBlacklisted(string $password): bool
    {
        static $BLACKLIST = null;
        return in_array(
            strtoupper($password),
            preg_split('/\v+/',
                strtoupper(
                    $BLACKLIST ?: $BLACKLIST = file_get_contents(__DIR__ . '/../resources/password-blacklist.txt')
                )
            )
        );
    }

    protected function isPasswordObvious(string $password): bool
    {
        foreach ($this->rejectAsTooObvious as $obvious) {
            if (strpos(strtolower($password), strtolower($obvious)) !== false) {
                return true;
            }
        }

        return is_numeric(str_replace([' ', '/', '-'], '', $password)); // Could be a DOB or phone number
    }

    protected function isRecentPassword(string $password): bool
    {
        foreach ($this->recentHashes as $hash) {
            if (password_verify($password, $hash)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $current
     * @param string $new
     *
     * @return bool
     */
    public static function change(string $current, string $new): bool
    {
        $userId = getUserId();

        addToAudit('pwUpdate', 0, 'password change $orig to $new');

        $current = md5($current);
        $sql = <<<MYSQL
SELECT user_id FROM Users WHERE user_id = ? AND `PASSWORD` = ? AND `DELETED` = 0
MYSQL;

        $binds = [$userId, $current];
        if (false === ($result = Db::query($sql, $binds)) || empty($result)) {
            return false;
        }

        $sql = <<<MYSQL
UPDATE Users SET `PASSWORD` = ? WHERE user_id = ?
MYSQL;

        $binds = [$new, $userId];
        Db::query($sql, $binds);

        return true;
    }
}
