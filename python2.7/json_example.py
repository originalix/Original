from flask import Flask, Response, jsonify

class MyResponse(Response):
    @classmethod
    def force_type(cls, response, environ=None):
        if isinstance(response, (list, dict)):
            response = jsonify(response)
        return super(Response, cls).force_type(response, environ)

class MyFlask(Flask):
    response_class = MyResponse

app = MyFlask(__name__)

@app.route('/')
def root():
    return {'a' : 'hello world', 'b' : 2150}

if __name__ == '__main__':
    app.debug = True
    app.run()
