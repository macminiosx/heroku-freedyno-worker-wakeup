#!/usr/bin/perl

use JSON;

# /* your setting start */

my $app = q{YOUR APP NAME};

# get token command is $ heroku auth:token
my $token = q{YOUR API TOKEN};

my $dyno_name = q{worker}; # worker or bot

my $curl = q{/usr/local/bin/curl};

# /* your setting end */

my $dynos_url = $curl . q{ -s -X GET https://api.heroku.com/apps/} . $app . qq{/dynos -H "Accept: application/vnd.heroku+json; version=3" -H "Authorization: Bearer } . $token . q{"};


my $res = `$dynos_url`;

my $json = JSON::from_json($res);

my $status = $json->[0];

my $state = $status->{'state'};

if ($state && $state eq 'idle') {
	my $restart_url = $curl . q{ -s -X DELETE https://api.heroku.com/apps/} . $app . q{/dynos/} . $dyno_name . qq{ -H "Accept: application/vnd.heroku+json; version=3" -H "Authorization: Bearer } . $token . q{"};
	my $res = `$restart_url`;
}

exit;
