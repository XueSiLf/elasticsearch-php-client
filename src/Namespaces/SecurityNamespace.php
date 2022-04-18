<?php
/**
 * Created by PhpStorm.
 * Author: hlh XueSi
 * Email: 1592328848@qq.com
 * Date: 2022/4/15 16:27:32
 */
declare(strict_types=1);

namespace LavaMusic\ElasticSearch\Namespaces;

use LavaMusic\ElasticSearch\Endpoints\Security;

/**
 * Class SecurityNamespace
 */
class SecurityNamespace extends AbstractNamespace
{
    /**
     * Enables authentication as a user and retrieve information about the authenticated user.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-authenticate.html
     */
    public function authenticate(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Security\Authenticate $endpoint */
        $endpoint = $endpointBuilder('Security\Authenticate');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Changes the passwords of users in the native realm and built-in users.
     *
     * $params['username'] = (string) The username of the user to change the password for
     * $params['refresh']  = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']     = (array) the new password for the user (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-change-password.html
     */
    public function changePassword(array $params = [])
    {
        $username = $this->extractArgument($params, 'username');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\ChangePassword $endpoint */
        $endpoint = $endpointBuilder('Security\ChangePassword');
        $endpoint->setParams($params);
        $endpoint->setUsername($username);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Clear a subset or all entries from the API key cache.
     *
     * $params['ids'] = (list) A comma-separated list of IDs of API keys to clear from the cache
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-clear-api-key-cache.html
     */
    public function clearApiKeyCache(array $params = [])
    {
        $ids = $this->extractArgument($params, 'ids');

        $endpointBuilder = $this->endpoints;
        /** @var Security\ClearApiKeyCache $endpoint */
        $endpoint = $endpointBuilder('Security\ClearApiKeyCache');
        $endpoint->setParams($params);
        $endpoint->setIds($ids);

        return $this->performRequest($endpoint);
    }

    /**
     * Evicts application privileges from the native application privileges cache.
     *
     * $params['application'] = (list) A comma-separated list of application names
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-clear-privilege-cache.html
     */
    public function clearCachedPrivileges(array $params = [])
    {
        $application = $this->extractArgument($params, 'application');

        $endpointBuilder = $this->endpoints;
        /** @var Security\ClearCachedPrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\ClearCachedPrivileges');
        $endpoint->setParams($params);
        $endpoint->setApplication($application);

        return $this->performRequest($endpoint);
    }

    /**
     * Evicts users from the user cache. Can completely clear the cache or evict specific users.
     *
     * $params['realms']    = (list) Comma-separated list of realms to clear
     * $params['usernames'] = (list) Comma-separated list of usernames to clear from the cache
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-clear-cache.html
     */
    public function clearCachedRealms(array $params = [])
    {
        $realms = $this->extractArgument($params, 'realms');

        $endpointBuilder = $this->endpoints;
        /** @var Security\ClearCachedRealms $endpoint */
        $endpoint = $endpointBuilder('Security\ClearCachedRealms');
        $endpoint->setParams($params);
        $endpoint->setRealms($realms);

        return $this->performRequest($endpoint);
    }

    /**
     * Evicts roles from the native role cache.
     *
     * $params['name'] = (list) Role name
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-clear-role-cache.html
     */
    public function clearCachedRoles(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\ClearCachedRoles $endpoint */
        $endpoint = $endpointBuilder('Security\ClearCachedRoles');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Evicts tokens from the service account token caches.
     *
     * $params['namespace'] = (string) An identifier for the namespace
     * $params['service']   = (string) An identifier for the service name
     * $params['name']      = (list) A comma-separated list of service token names
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-clear-service-token-caches.html
     */
    public function clearCachedServiceTokens(array $params = [])
    {
        $namespace = $this->extractArgument($params, 'namespace');
        $service = $this->extractArgument($params, 'service');
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\ClearCachedServiceTokens $endpoint */
        $endpoint = $endpointBuilder('Security\ClearCachedServiceTokens');
        $endpoint->setParams($params);
        $endpoint->setNamespace($namespace);
        $endpoint->setService($service);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates an API key for access without requiring basic authentication.
     *
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']    = (array) The api key request to create an API key (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-create-api-key.html
     */
    public function createApiKey(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\CreateApiKey $endpoint */
        $endpoint = $endpointBuilder('Security\CreateApiKey');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a service account token for access without requiring basic authentication.
     *
     * $params['namespace'] = (string) An identifier for the namespace (Required)
     * $params['service']   = (string) An identifier for the service name (Required)
     * $params['name']      = (string) An identifier for the token name
     * $params['refresh']   = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` (the default) then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-create-service-token.html
     */
    public function createServiceToken(array $params = [])
    {
        $namespace = $this->extractArgument($params, 'namespace');
        $service = $this->extractArgument($params, 'service');
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\CreateServiceToken $endpoint */
        $endpoint = $endpointBuilder('Security\CreateServiceToken');
        $endpoint->setParams($params);
        $endpoint->setNamespace($namespace);
        $endpoint->setService($service);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Removes application privileges.
     *
     * $params['application'] = (string) Application name
     * $params['name']        = (string) Privilege name
     * $params['refresh']     = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-delete-privilege.html
     */
    public function deletePrivileges(array $params = [])
    {
        $application = $this->extractArgument($params, 'application');
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\DeletePrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\DeletePrivileges');
        $endpoint->setParams($params);
        $endpoint->setApplication($application);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Removes roles in the native realm.
     *
     * $params['name']    = (string) Role name
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-delete-role.html
     */
    public function deleteRole(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\DeleteRole $endpoint */
        $endpoint = $endpointBuilder('Security\DeleteRole');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Removes role mappings.
     *
     * $params['name']    = (string) Role-mapping name
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-delete-role-mapping.html
     */
    public function deleteRoleMapping(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\DeleteRoleMapping $endpoint */
        $endpoint = $endpointBuilder('Security\DeleteRoleMapping');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes a service account token.
     *
     * $params['namespace'] = (string) An identifier for the namespace
     * $params['service']   = (string) An identifier for the service name
     * $params['name']      = (string) An identifier for the token name
     * $params['refresh']   = (enum) If `true` then refresh the affected shards to make this operation visible to search, if `wait_for` (the default) then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-delete-service-token.html
     */
    public function deleteServiceToken(array $params = [])
    {
        $namespace = $this->extractArgument($params, 'namespace');
        $service = $this->extractArgument($params, 'service');
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\DeleteServiceToken $endpoint */
        $endpoint = $endpointBuilder('Security\DeleteServiceToken');
        $endpoint->setParams($params);
        $endpoint->setNamespace($namespace);
        $endpoint->setService($service);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes users from the native realm.
     *
     * $params['username'] = (string) username
     * $params['refresh']  = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-delete-user.html
     */
    public function deleteUser(array $params = [])
    {
        $username = $this->extractArgument($params, 'username');

        $endpointBuilder = $this->endpoints;
        /** @var Security\DeleteUser $endpoint */
        $endpoint = $endpointBuilder('Security\DeleteUser');
        $endpoint->setParams($params);
        $endpoint->setUsername($username);

        return $this->performRequest($endpoint);
    }

    /**
     * Disables users in the native realm.
     *
     * $params['username'] = (string) The username of the user to disable
     * $params['refresh']  = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-disable-user.html
     */
    public function disableUser(array $params = [])
    {
        $username = $this->extractArgument($params, 'username');

        $endpointBuilder = $this->endpoints;
        /** @var Security\DisableUser $endpoint */
        $endpoint = $endpointBuilder('Security\DisableUser');
        $endpoint->setParams($params);
        $endpoint->setUsername($username);

        return $this->performRequest($endpoint);
    }

    /**
     * Enables users in the native realm.
     *
     * $params['username'] = (string) The username of the user to enable
     * $params['refresh']  = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-enable-user.html
     */
    public function enableUser(array $params = [])
    {
        $username = $this->extractArgument($params, 'username');

        $endpointBuilder = $this->endpoints;
        /** @var Security\EnableUser $endpoint */
        $endpoint = $endpointBuilder('Security\EnableUser');
        $endpoint->setParams($params);
        $endpoint->setUsername($username);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information for one or more API keys.
     *
     * $params['id']         = (string) API key id of the API key to be retrieved
     * $params['name']       = (string) API key name of the API key to be retrieved
     * $params['username']   = (string) user name of the user who created this API key to be retrieved
     * $params['realm_name'] = (string) realm name of the user who created this API key to be retrieved
     * $params['owner']      = (boolean) flag to query API keys owned by the currently authenticated user (Default = false)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-api-key.html
     */
    public function getApiKey(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Security\GetApiKey $endpoint */
        $endpoint = $endpointBuilder('Security\GetApiKey');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves the list of cluster privileges and index privileges that are available in this version of Elasticsearch.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-builtin-privileges.html
     */
    public function getBuiltinPrivileges(array $params = [])
    {

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetBuiltinPrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\GetBuiltinPrivileges');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves application privileges.
     *
     * $params['application'] = (string) Application name
     * $params['name']        = (string) Privilege name
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-privileges.html
     */
    public function getPrivileges(array $params = [])
    {
        $application = $this->extractArgument($params, 'application');
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetPrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\GetPrivileges');
        $endpoint->setParams($params);
        $endpoint->setApplication($application);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves roles in the native realm.
     *
     * $params['name'] = (list) A comma-separated list of role names
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-role.html
     */
    public function getRole(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetRole $endpoint */
        $endpoint = $endpointBuilder('Security\GetRole');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves role mappings.
     *
     * $params['name'] = (list) A comma-separated list of role-mapping names
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-role-mapping.html
     */
    public function getRoleMapping(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetRoleMapping $endpoint */
        $endpoint = $endpointBuilder('Security\GetRoleMapping');
        $endpoint->setParams($params);
        $endpoint->setName($name);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information about service accounts.
     *
     * $params['namespace'] = (string) An identifier for the namespace
     * $params['service']   = (string) An identifier for the service name
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-service-accounts.html
     */
    public function getServiceAccounts(array $params = [])
    {
        $namespace = $this->extractArgument($params, 'namespace');
        $service = $this->extractArgument($params, 'service');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetServiceAccounts $endpoint */
        $endpoint = $endpointBuilder('Security\GetServiceAccounts');
        $endpoint->setParams($params);
        $endpoint->setNamespace($namespace);
        $endpoint->setService($service);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information of all service credentials for a service account.
     *
     * $params['namespace'] = (string) An identifier for the namespace
     * $params['service']   = (string) An identifier for the service name
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-service-credentials.html
     */
    public function getServiceCredentials(array $params = [])
    {
        $namespace = $this->extractArgument($params, 'namespace');
        $service = $this->extractArgument($params, 'service');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetServiceCredentials $endpoint */
        $endpoint = $endpointBuilder('Security\GetServiceCredentials');
        $endpoint->setParams($params);
        $endpoint->setNamespace($namespace);
        $endpoint->setService($service);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a bearer token for access without requiring basic authentication.
     *
     * $params['body'] = (array) The token request to get (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-token.html
     */
    public function getToken(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetToken $endpoint */
        $endpoint = $endpointBuilder('Security\GetToken');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information about users in the native realm and built-in users.
     *
     * $params['username'] = (list) A comma-separated list of usernames
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-user.html
     */
    public function getUser(array $params = [])
    {
        $username = $this->extractArgument($params, 'username');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GetUser $endpoint */
        $endpoint = $endpointBuilder('Security\GetUser');
        $endpoint->setParams($params);
        $endpoint->setUsername($username);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves security privileges for the logged in user.
     *
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-get-user-privileges.html
     */
    public function getUserPrivileges(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        /** @var Security\GetUserPrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\GetUserPrivileges');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates an API key on behalf of another user.
     *
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']    = (array) The api key request to create an API key (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-grant-api-key.html
     */
    public function grantApiKey(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\GrantApiKey $endpoint */
        $endpoint = $endpointBuilder('Security\GrantApiKey');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Determines whether the specified user has a specified list of privileges.
     *
     * $params['user'] = (string) Username
     * $params['body'] = (array) The privileges to test (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-has-privileges.html
     */
    public function hasPrivileges(array $params = [])
    {
        $user = $this->extractArgument($params, 'user');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\HasPrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\HasPrivileges');
        $endpoint->setParams($params);
        $endpoint->setUser($user);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Invalidates one or more API keys.
     *
     * $params['body'] = (array) The api key request to invalidate API key(s) (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-invalidate-api-key.html
     */
    public function invalidateApiKey(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\InvalidateApiKey $endpoint */
        $endpoint = $endpointBuilder('Security\InvalidateApiKey');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Invalidates one or more access tokens or refresh tokens.
     *
     * $params['body'] = (array) The token to invalidate (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-invalidate-token.html
     */
    public function invalidateToken(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\InvalidateToken $endpoint */
        $endpoint = $endpointBuilder('Security\InvalidateToken');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds or updates application privileges.
     *
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']    = (array) The privilege(s) to add (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-put-privileges.html
     */
    public function putPrivileges(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\PutPrivileges $endpoint */
        $endpoint = $endpointBuilder('Security\PutPrivileges');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds and updates roles in the native realm.
     *
     * $params['name']    = (string) Role name
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']    = (array) The role to add (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-put-role.html
     */
    public function putRole(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\PutRole $endpoint */
        $endpoint = $endpointBuilder('Security\PutRole');
        $endpoint->setParams($params);
        $endpoint->setName($name);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates and updates role mappings.
     *
     * $params['name']    = (string) Role-mapping name
     * $params['refresh'] = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']    = (array) The role mapping to add (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-put-role-mapping.html
     */
    public function putRoleMapping(array $params = [])
    {
        $name = $this->extractArgument($params, 'name');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\PutRoleMapping $endpoint */
        $endpoint = $endpointBuilder('Security\PutRoleMapping');
        $endpoint->setParams($params);
        $endpoint->setName($name);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds and updates users in the native realm. These users are commonly referred to as native users.
     *
     * $params['username'] = (string) The username of the User
     * $params['refresh']  = (enum) If `true` (the default) then refresh the affected shards to make this operation visible to search, if `wait_for` then wait for a refresh to make this operation visible to search, if `false` then do nothing with refreshes. (Options = true,false,wait_for)
     * $params['body']     = (array) The user to add (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-put-user.html
     */
    public function putUser(array $params = [])
    {
        $username = $this->extractArgument($params, 'username');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\PutUser $endpoint */
        $endpoint = $endpointBuilder('Security\PutUser');
        $endpoint->setParams($params);
        $endpoint->setUsername($username);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Retrieves information for API keys using a subset of query DSL
     *
     * $params['body'] = (array) From, size, query, sort and search_after
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-query-api-key.html
     */
    public function queryApiKeys(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\QueryApiKeys $endpoint */
        $endpoint = $endpointBuilder('Security\QueryApiKeys');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Exchanges a SAML Response message for an Elasticsearch access token and refresh token pair
     *
     * $params['body'] = (array) The SAML response to authenticate (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-saml-authenticate.html
     */
    public function samlAuthenticate(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\SamlAuthenticate $endpoint */
        $endpoint = $endpointBuilder('Security\SamlAuthenticate');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Verifies the logout response sent from the SAML IdP
     *
     * $params['body'] = (array) The logout response to verify (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-saml-complete-logout.html
     */
    public function samlCompleteLogout(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\SamlCompleteLogout $endpoint */
        $endpoint = $endpointBuilder('Security\SamlCompleteLogout');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Consumes a SAML LogoutRequest
     *
     * $params['body'] = (array) The LogoutRequest message (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-saml-invalidate.html
     */
    public function samlInvalidate(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\SamlInvalidate $endpoint */
        $endpoint = $endpointBuilder('Security\SamlInvalidate');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Invalidates an access token and a refresh token that were generated via the SAML Authenticate API
     *
     * $params['body'] = (array) The tokens to invalidate (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-saml-logout.html
     */
    public function samlLogout(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\SamlLogout $endpoint */
        $endpoint = $endpointBuilder('Security\SamlLogout');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Creates a SAML authentication request
     *
     * $params['body'] = (array) The realm for which to create the authentication request, identified by either its name or the ACS URL (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-saml-prepare-authentication.html
     */
    public function samlPrepareAuthentication(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        /** @var Security\SamlPrepareAuthentication $endpoint */
        $endpoint = $endpointBuilder('Security\SamlPrepareAuthentication');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Generates SAML metadata for the Elastic stack SAML 2.0 Service Provider
     *
     * $params['realm_name'] = (string) The name of the SAML realm to get the metadata for
     *
     * @param array $params Associative array of parameters
     * @return array
     * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/security-api-saml-sp-metadata.html
     */
    public function samlServiceProviderMetadata(array $params = [])
    {
        $realm_name = $this->extractArgument($params, 'realm_name');

        $endpointBuilder = $this->endpoints;
        /** @var Security\SamlServiceProviderMetadata $endpoint */
        $endpoint = $endpointBuilder('Security\SamlServiceProviderMetadata');
        $endpoint->setParams($params);
        $endpoint->setRealmName($realm_name);

        return $this->performRequest($endpoint);
    }
}