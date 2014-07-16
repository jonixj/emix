cd /var/www
rm -rf emix
git clone https://github.com/jonixj/emix.git
cd emix/backend
cd
sudo apt-get update
sudo apt-get install git-core curl build-essential openssl libssl-dev
git clone https://github.com/joyent/node.git
cd node
git checkout v0.8.9
./configure
make
sudo make install
cd
rm -rf node
npm install -g bower


