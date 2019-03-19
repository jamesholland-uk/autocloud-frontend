#!/bin/sh

/usr/bin/gcloud --no-user-output-enabled auth activate-service-account --key-file=gcp_compute_key_svc_cloud-automation.json
/usr/bin/gcloud --no-user-output-enabled config set project cloud-automation-demo

mgmt_ip=`/usr/bin/gcloud compute instances list | grep fw- | grep $1 | awk -F"[ ,]+" '{print $8}'`
untrust_ip=`/usr/bin/gcloud compute instances list | grep fw- | grep $1 | awk -F"[ ,]+" '{print $9}'`
kali_ip=`/usr/bin/gcloud compute instances list | grep kali- | grep $1 | awk '{print $5}'`

touch links.html
echo '' > links.html

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><link rel="stylesheet" href="stylesheet.css" type="text/css"><title>Cloudy Attacker</title></head><body>' >> links.html

echo ""
echo "Firewall Management                      https://${mgmt_ip}" >> links.html
echo "Panorama Management                      https://rama.panw.co.uk"
echo "Metasploit Console                       http://${kali_ip}:4200"
echo "Java Web App                             http://${untrust_ip}:8080/struts2_2.3.15.1-showcase/showcase.action"
echo "PHP Web App                              http://${untrust_ip}"
echo "Generic XSS Attack                       http://${untrust_ip}?uoGSo[]=%3Cscript%3Ealert(%E2%80%98BreakingPoint%E2%80%99)%3C/script%3E"
echo "Generic Traversal and /etc/passwd Access http://${untrust_ip}/graph.php?current_language=/../../../../../../../../etc/passwd.&module=Accounts&action=Import&parenttab=Support%5D"
echo "Web Server Console                       http://${untrust_ip}:4200"
echo ""

echo '</body></html>' >> links.html