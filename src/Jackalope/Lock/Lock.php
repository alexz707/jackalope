<?php

namespace Jackalope\Lock;

use PHPCR\Lock\LockInterface;

/**
 * {@inheritDoc}
 *
 * @api
 */
class Lock implements LockInterface
{
    /** @var string */
    protected $lockOwner;

    /** @var boolean */
    protected $isDeep;

    /** @var \PHPCR\NodeInterface */
    protected $node;

    /** @var string */
    protected $lockToken;

    /** @var boolean */
    protected $isLive;

    /** @var boolean */
    protected $isSessionScoped;

    /** @var boolean */
    protected $isLockOwningSession;

    /**
     * The unix timestamp (seconds since 1970) at which this lock will expire
     *
     * @var int
     */
    protected $expire;

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getLockOwner()
    {
        return $this->lockOwner;
    }

    /**
     * @param string $owner
     * @private
     */
    public function setLockOwner($owner)
    {
        $this->lockOwner = $owner;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function isDeep()
    {
        return $this->isDeep;
    }

    /**
    * @param boolean $isDeep
     * @private
    */
    public function setIsDeep($isDeep)
    {
        $this->isDeep = $isDeep;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @param \PHPCR\NodeInterface $node
     * @private
     */
    public function setNode(\PHPCR\NodeInterface $node)
    {
        $this->node = $node;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getLockToken()
    {
        return $this->lockToken;
    }

    /**
     * @param string $token
     * @private
     */
    public function setLockToken($token)
    {
        $this->lockToken = $token;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function getSecondsRemaining()
    {
        // The timeout does not seem to be correctly implemented in Jackrabbit. Thus we
        // always return the max timeout value
        if (null === $this->expire) {
            return PHP_INT_MAX;
        }

        return $this->expire - time();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function isLive()
    {
        return $this->isLive;
    }

    /**
    * @param boolean $isLive
     * @private
    */
    public function setIsLive($isLive)
    {
        $this->isLive = $isLive;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function isSessionScoped()
    {
        return $this->isSessionScoped;
    }

    /**
     * @param boolean $isSessionScoped
     * @private
     */
    public function setIsSessionScoped($isSessionScoped)
    {
        $this->isSessionScoped = $isSessionScoped;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     */
    public function isLockOwningSession()
    {
        return $this->isLockOwningSession;
    }

    /**
     * @param boolean $isLockOwningSession
     * @private
     */
    public function setIsLockOwningSession($isLockOwningSession)
    {
        $this->isLockOwningSession = $isLockOwningSession;
    }

    /**
     * Set the lock expire timestamp
     *
     * Set to null for unknown / infinite timeout
     *
     * @param int $expire timestamp when this lock will expire in seconds of unix epoch
     *
     * @private
     *
     * @see http://ch.php.net/manual/en/function.time.php
     */
    public function setExpireTime($expire)
    {
        $this->expire = $expire;
    }

    /**
    * {@inheritDoc}
    *
    * @api
    */
    public function refresh()
    {
        throw new NotImplementedException();
    }
}
