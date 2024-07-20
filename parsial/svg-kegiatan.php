              <div class="w-full px-4 lg:w-4/12">
                <div>
                  <div class="wow fadeInUp relative mb-12 overflow-hidden rounded-[5px] bg-primary px-11 py-[60px] text-left lg:px-8" data-wow-delay=".1s">
                    <h3 class="mb-[6px] text-[28px] font-semibold leading-[40px] text-white"> Detil Kegiatan </h3>
                    <p class="mb-5 text-base text-white"><strong>Mulai:</strong> <?php echo EventController::formatTanggalIndonesia($event['start_date']); ?></p>
                    <p class="mb-5 text-base text-white"><strong>Selesai:</strong> <?php echo EventController::formatTanggalIndonesia($event['end_date']); ?></p>
                    <p class="mb-5 text-base text-white"><strong>Alamat:</strong> <?php echo htmlspecialchars($event['address']); ?></p>
                    <p class="text-sm font-medium text-white"><strong>Lokasi:</strong> <?php echo htmlspecialchars($event['location']); ?></span>
                      <span class="absolute top-0 right-0">
                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="1.39737" cy="44.6026" r="1.39737" transform="rotate(-90 1.39737 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="1.39737" cy="7.9913" r="1.39737" transform="rotate(-90 1.39737 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="44.6026" r="1.39737" transform="rotate(-90 13.6943 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="7.9913" r="1.39737" transform="rotate(-90 13.6943 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="44.6026" r="1.39737" transform="rotate(-90 25.9911 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="7.9913" r="1.39737" transform="rotate(-90 25.9911 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="44.6026" r="1.39737" transform="rotate(-90 38.288 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="7.9913" r="1.39737" transform="rotate(-90 38.288 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="1.39737" cy="32.3058" r="1.39737" transform="rotate(-90 1.39737 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="32.3058" r="1.39737" transform="rotate(-90 13.6943 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="32.3058" r="1.39737" transform="rotate(-90 25.9911 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="32.3058" r="1.39737" transform="rotate(-90 38.288 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="1.39737" cy="20.0086" r="1.39737" transform="rotate(-90 1.39737 20.0086)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="20.0086" r="1.39737" transform="rotate(-90 13.6943 20.0086)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="20.0086" r="1.39737" transform="rotate(-90 25.9911 20.0086)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="20.0086" r="1.39737" transform="rotate(-90 38.288 20.0086)" fill="white" fill-opacity="0.44" />
                        </svg>
                      </span>
                      <span class="absolute bottom-0 left-0">
                        <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <circle cx="1.39737" cy="44.6026" r="1.39737" transform="rotate(-90 1.39737 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="1.39737" cy="7.9913" r="1.39737" transform="rotate(-90 1.39737 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="44.6026" r="1.39737" transform="rotate(-90 13.6943 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="7.9913" r="1.39737" transform="rotate(-90 13.6943 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="44.6026" r="1.39737" transform="rotate(-90 25.9911 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="7.9913" r="1.39737" transform="rotate(-90 25.9911 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="44.6026" r="1.39737" transform="rotate(-90 38.288 44.6026)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="7.9913" r="1.39737" transform="rotate(-90 38.288 7.9913)" fill="white" fill-opacity="0.44" />
                          <circle cx="1.39737" cy="32.3058" r="1.39737" transform="rotate(-90 1.39737 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="32.3058" r="1.39737" transform="rotate(-90 13.6943 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="32.3058" r="1.39737" transform="rotate(-90 25.9911 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="32.3058" r="1.39737" transform="rotate(-90 38.288 32.3058)" fill="white" fill-opacity="0.44" />
                          <circle cx="1.39737" cy="20.0086" r="1.39737" transform="rotate(-90 1.39737 20.0086)" fill="white" fill-opacity="0.44" />
                          <circle cx="13.6943" cy="20.0086" r="1.39737" transform="rotate(-90 13.6943 20.0086)" fill="white" fill-opacity="0.44" />
                          <circle cx="25.9911" cy="20.0086" r="1.39737" transform="rotate(-90 25.9911 20.0086)" fill="white" fill-opacity="0.44" />
                          <circle cx="38.288" cy="20.0086" r="1.39737" transform="rotate(-90 38.288 20.0086)" fill="white" fill-opacity="0.44" />
                        </svg>
                      </span>
                    </div>
                  </div>
                </div>
              </div>