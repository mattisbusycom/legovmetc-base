require 'rubygems'
require 'hpricot'
require 'open-uri'

require 'rest-client'

auctions = 'http://www.ebay.com/sch/Sets-/19006/i.html?_mPrRngCbx=1&_udlo=80&_udhi=&rt=nc&LH_Auction=1'

doc = Hpricot(open("#{auctions}"))

## Get Listings
Listings = doc.search("//ul#ListViewInner")

Listings.each do |i|
	pp i
	puts "bids # #{pp i.search("//bids")}"
	puts "price @ #{pp i.search("//prc")}"
	puts "\n-------------------------\n"
end
