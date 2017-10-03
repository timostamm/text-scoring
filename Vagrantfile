# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.box_version = "=20160320.0.0"
  config.vm.box_check_update = false
 
  config.vm.provider "virtualbox" do |v|
  	v.memory = 4000
  end
 
  config.vm.provision :puppet do |puppet|
    puppet.module_path = "vagrant-puppet/modules"
    puppet.manifests_path = "vagrant-puppet/manifests"
    puppet.manifest_file = "site.pp"
    puppet.facter = {
      
      "logroot" => "/var/log",
      
	  "php" => "7", # 7 or 5 
	 
    }
  end
end
