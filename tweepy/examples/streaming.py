from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream

# Go to http://dev.twitter.com and create an app.
# The consumer key and secret will be generated for you after
consumer_key="WxlLPjHHynHASubxXPtuHQ"
consumer_secret="ZsyLG0t1H4WWtwewdp12fbIJyZre6aE306JP9sY"

# After the step above, you will be redirected to your app's page.
# Create an access token under the the "Your access token" section
access_token="19610295-TtV1mgxk09JYW4GQFFBY2nzvDGaWAtRwa3yfTdmds"
access_token_secret="gQYrVkmvXKo821HZmwIFBhuISKIIgMB3m3r96QdQfIY"

class StdOutListener(StreamListener):
    """ A listener handles tweets are the received from the stream.
    This is a basic listener that just prints received tweets to stdout.

    """
    def on_data(self, data):
        print data
        return True

    def on_error(self, status):
        print status

if __name__ == '__main__':
    l = StdOutListener()
    auth = OAuthHandler(consumer_key, consumer_secret)
    auth.set_access_token(access_token, access_token_secret)

    stream = Stream(auth, l)
    stream.filter(track=['basketball'])
